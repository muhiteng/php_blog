<?php


namespace Interfaces;


interface CategoryRepositoryInterface
{

    // get all posts
    public function index();
    // create new post
    public function create();
// insert new post
    public function store($post);
    // update post
    public function update($post);
    // destroy post
    public function destroy($post);

}
