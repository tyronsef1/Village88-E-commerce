<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    function get_all_products()
    {
        return $this->db->query("SELECT * FROM products")->result_array();
    }
    function get_product_by_id($product_id)
    {
        return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id))->row_array();
    }
    function add_product($product)
    {
        $query = "INSERT INTO orders (product_id, product_quantity, created_at) VALUES (?,?,?)";
        $values = array($product['product_id'], $product['product_quantity'], date("Y-m-d, H:i:s")); 
        return $this->db->query($query, $values);
    }
    function show_cart()
    {
        return $this->db->query("SELECT orders.id AS id, orders.product_quantity AS quantity, products.description AS description, products.price*orders.product_quantity AS price
                                    FROM orders 
                                        LEFT JOIN products 
                                        ON orders.product_id = products.id;")->result_array();
    }
    function delete_order($product_id)
    {
        $query = "DELETE FROM orders WHERE id = ?";
        $values = array($product_id);
        return $this->db->query($query, $values);
    }
    function delete_all_orders()
    {
        $query = "DELETE FROM orders";
        return $this->db->query($query);
    }
    function total_price()
    {
        return $this->db->query("SELECT SUM(products.price*orders.product_quantity) AS total_price
                    FROM orders 
                        LEFT JOIN products 
                        ON orders.product_id = products.id;")->row_array();
    }
}
