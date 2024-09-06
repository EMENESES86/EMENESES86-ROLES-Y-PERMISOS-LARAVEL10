<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Admin;


class ProfileComposer {

	private $request;

    /**
     * Pass $request
     */
    public function __construct(Request $request)
    {
       $this->request = $request;
    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    	$cateall = Categoria::get();
        $view->with('cateall', $cateall);

        $admin = Admin::first();
        $view->with('admin', $admin);



    }

}
