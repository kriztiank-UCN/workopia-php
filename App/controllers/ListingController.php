<?php

namespace App\Controllers;

use Framework\Database;

class ListingController
{
  protected $db;

  public function __construct()
  {
    $config = require basePath('config/_db.php');
    $this->db = new Database($config);
  }

   /**
   * Show all listings
   * 
   * @return void
   */
  public function index()
  {
    $listings = $this->db->query('SELECT * FROM listings')->fetchAll();

    loadView('home', [
      'listings' => $listings
    ]);
  }

   /**
   * Show the create listing form
   * 
   * @return void
   */
  public function create()
  {
    loadView('listings/create');
  }

   /**
   * Show a single listing
   * 
   * @param array $params
   * @return void
   */
  public function show()
  {
    $id = $_GET['id'] ?? '';
    // inspect($id);

    $params = [
      // named params
      'id' => $id
    ];

    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
    // inspect($listing);

    // get the data from the database where that listing id matches the id in the url
    // load view and pass in the listing from the database, access them in the view with $listings
    loadView('listings/show', [
      'listing' => $listing
    ]);
  }
}
