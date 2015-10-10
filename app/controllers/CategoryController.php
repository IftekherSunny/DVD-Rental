<?php

class CategoryController extends BaseController 
{
	/**
	 * This function responses to 
	 * the get request of /admin/category/create
	 */
	public function getCreate()
	{
		
		return View::make('adminArea.category.create');
	}

	/**
	 * This function creates category
	 * when data is posted from 
	 * /admin/category/create
	 */
	public function postCreate()
	{
		// Check validation
		$validator = Validator::make(Input::all(), Category::$rulesForCreate);
		
		// If failed then redirect to employee-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('category-create-get')
						->withErrors($validator)
						->withInput();
		}

		$category = Category::create(array(
			'name'	=> Input::get('name'),
		));
		
		return View::make('adminArea.category.create')
					->with('success', 'Category has been created successfully');
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/category
	 *  and shows all category as list
	 */
	public function getViewAllCategory($msg = null)
	{
		if(!empty($msg) && ($msg == 1))
		{
			return View::make('adminArea.category.view')
					->with('categories',Category::orderBy('id','desc')->get())
					->with('success', 'Category has been deleted successfully');
		}
		
		return View::make('adminArea.category.view')
					->with('categories',Category::orderBy('id','desc')->get());
	}

	/**
	 *  This function responses  to the 
	 *  post request of the /admin/category/action
	 *  then check which button is pressed in the
	 *  form of category.view.blade.php of the 
	 *  route /admin/category
	 */
	public function postAction()
	{
		// Holding checked row value from category table
		$id = Input::get('checked');

		/**
		 *  Redirected route if Edit button is pressed
		 */
		if(Input::has('Edit'))
			return Redirect::route('category-edit-get',$id);

		/**
		 *  Redirected route if Details button is pressed
		 */
		if(Input::has('Add'))
			return Redirect::route('category-create-get');

		/**
		 *  Redirected route if Print button is pressed
		 */
		if(Input::has('Print'))
			return Redirect::route('category-print-get');

		/**
		 *  If Delete button is pressed
		 *  destroy function finds category by id
		 *  and deletes the category from category table
		 */
		if(Input::has('Delete'))
		{
			foreach ($id as $categoryId) {				
				$category = Category::find($categoryId);
				$category->delete();
			}

			return Redirect::route('category-get',1);
		}

		return View::make('errors/404');
				
	}

	/**
	 *  This function responses to
	 *  the get request of /admin/category/edit/{id}/{msg?}
	 *  and show category respect to id
	 */
	public function getEdit($id,$msg = null)
	{
		$category = Category::find($id);
		
		if($category)
		{
			if(!empty($msg) && ($msg == 1))
			{
				return View::make('adminArea.category.edit')
						->with('category',$category)
						->with('success', 'Category has been updated successfully');
			}
			
			return View::make('adminArea.category.edit')
						->with('category',$category);
		}

		return View::make('errors/404');
	}

	/**
	 *  This function responses to
	 *  the post request of /admin/category/edit/{id}/{msg?}
	 *  and update category respect to id
	 */
	public function postEdit()
	{
		// Holding id
		$id = Input::get('id');

		// Check validation
		$validator = Validator::make(Input::all(), Category::$rulesForCreate);

		// If failed then redirect to category-create-get route with 
		// validation error and input old
		if($validator->fails())
		{
			return Redirect::route('category-edit-get',$id)
						->withErrors($validator)
						->withInput();
		}

		$category = Category::find($id);
		
		$category->name 			= Input::get('name'); 
		$category->save();

		return Redirect::route('category-edit-get',array($id,1));
						
	}
}
