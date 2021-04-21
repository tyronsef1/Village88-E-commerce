<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function index()
	{
        $this->load->model('Product_model');
        $view_data['products'] = $this->Product_model->get_all_products();
        $this->load->view('products/products_listing.php', $view_data);
	}
    public function buy($product_id)
    {
        $this->load->model('Product_model');
        $product = array(
            'product_id' => $product_id,
            'product_quantity' => $this->input->post('product_quantity', TRUE)
        );
        $add_product = $this->Product_model->add_product($product);
        if($add_product === TRUE) {
            $this->session->set_flashdata("add_success", "Successfully added a product!");
            redirect('products');
        }
    }
    public function show()
    {
        $this->load->model('Product_model');
        $view_cart['products'] = $this->Product_model->show_cart();
        $view_cart['total'] = $this->Product_model->total_price();
        $this->load->view('products/cart.php', $view_cart);
        
    }
    public function delete($product_id)
    {
        $this->load->model('Product_model');
        $delete_product = $this->Product_model->delete_order($product_id);
        if ($delete_product ===TRUE) 
        {
            $this->session->set_flashdata("delete_success", "Successfully deleted a product!");
            redirect('../products/show');
        }
    }
    public function checkout()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules("name", "Name", "required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("card_number", "Card Number", "required|exact_length[12]|numeric");
        if($this->form_validation->run() === FALSE)
        {
            $this->session->set_flashdata("login_error", validation_errors());
            redirect("products/show");
        }
        else
        {
            redirect("products/logout");
        }
    }
    public function logout()
    {
        $this->load->model('Product_model');
        $delete_form = $this->Product_model->delete_all_orders();
        if($delete_form === TRUE) 
        {
            $this->session->set_flashdata("order_success", "Successfully ordered");
            redirect("products");
        }
    }
}
