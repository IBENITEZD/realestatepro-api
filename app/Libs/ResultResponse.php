<?php

namespace App\Libs;

class ResultResponse
{
    const SUCCESS_CODE=200;
    const ERROR_CODE=300;
    const ERROR_ELEMENT_NOT_FOUND_CODE=404;

    const TXT_SUCCESS_CODE='Success';
    const TXT_ERROR_CODE='Error';
    const TXT_ERROR_ELEMENT_NOT_FOUND_CODE='Elemnt not found';

    public $statusCode;
    public $message;
    public $data;
    public $current_page;
    public $total_pages;
    public $total_items;
    public $per_page;
    public $next_page_url;
    public $prev_page_url;


    function __construct(){
        $this->statusCode =  self::ERROR_CODE;
        $this->message = 'Error';
        $this->data = '';
        $this->current_page = '';
        $this->total_pages = '';
        $this->total_items = '';
        $this->per_page = '';
        $this->next_page_url = '';
        $this->prev_page_url = '';
    }

    /**
     * @return mixed
     */

    // Método para devolver una respuesta con error
    public function getStatusCode()
    {
        return $this-> statusCode;
    }

    /**
     * @param mixed $code
     */
    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @retunr mixed
     */
    public function getMessage()
    {
        return $this-> message;
    }

    /**
     * @param mixed $message
     */

     public function setMessage($message): void
     {
         $this->message = $message;
     } 
    
    /**
     * @return mixed
     */ 

    public function getData()
    {
        return $this->data;
    } 

    /**
     * @param mixed $message
     */ 

     public function setData($data): void
    {
         $this->data = $data;
    } 

    public function getCurrent_page()
    {
        return $this->current_page;
    } 

    /**
     * @param mixed $current_page
     */ 

     public function setCurrent_page($current_page): void
    {
         $this->current_page = $current_page;
    } 

    public function getTotal_pages()
    {
        return $this->total_pages;
    } 

    /**
     * @param mixed $total_pages
     */ 

     public function setTotal_pages($total_pages): void
    {
         $this->total_pages = $total_pages;
    } 


    public function getTotal_items()
    {
        return $this->total_items;
    } 

    /**
     * @param mixed $total_items
     */ 

     public function setTotal_items($total_items): void
    {
         $this->total_items = $total_items;
    }


    public function getPer_page()
    {
        return $this->per_page;
    } 

    /**
     * @param mixed $per_page
     */ 

     public function setPer_page($per_page): void
    {
         $this->per_page = $per_page;
    }


    public function getNext_page_url()
    {
        return $this->next_page_url;
    } 

    /**
     * @param mixed $next_page_url
     */ 

     public function setNext_page_url($next_page_url): void
    {
         $this->next_page_url = $next_page_url;
    }


    public function getPrev_page_url()
    {
        return $this->prev_page_url;
    } 

    /**
     * @param mixed $prev_page_url
     */ 

     public function setPrev_page_url($prev_page_url): void
    {
         $this->prev_page_url = $prev_page_url;
    }


}

