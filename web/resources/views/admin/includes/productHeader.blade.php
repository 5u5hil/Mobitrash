

<!--
<ul class="nav nav-tabs">
                  <li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Activity</a></li>
                  <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Timeline</a></li>
                  <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
                </ul>-->



<ul class="nav nav-tabs" role="tablist">
    <li class="{{ in_array(Route::currentRouteName(),['admin.products.general.info']) ? 'active' : '' }}"><a href="{!! route('admin.products.general.info',['id'=>$id]) !!}"   aria-expanded="false">General Info <span class="badge badge-sm m-l-xs"></span></a></li>
    <li class="{{ in_array(Route::currentRouteName(),['admin.products.edit.category']) ? 'active' : '' }}"><a href="{!! route('admin.products.edit.category',['id'=>$id]) !!}"  aria-expanded="false">Category</a></li>


    <li class="{{ in_array(Route::currentRouteName(),['admin.products.images']) ? 'active' : '' }}"><a href="{!! route('admin.products.images',['id'=>$id]) !!}"  aria-expanded="false">Images</a></li>


    @if($prod_type == 2)
    <li class="{{ in_array(Route::currentRouteName(),['admin.combo.products.view']) ? 'active' : '' }}"><a href="{!! route('admin.combo.products.view',['id'=>$id]) !!}"  aria-expanded="false">Combo Products</a></li>
    @endif

    @if($prod_type == 3)

    <li class="{{ in_array(Route::currentRouteName(),['admin.products.configurable.attributes']) ? 'active' : '' }}"><a href="{!! route('admin.products.configurable.attributes',['id'=>$id]) !!}"  aria-expanded="false">Product Variants </a></li>



    @endif
   @if($prod_type == 4)

    <li class="{{ in_array(Route::currentRouteName(),['admin.products.configurable.without.stock.attributes']) ? 'active' : '' }}"><a href="{!! route('admin.products.configurable.without.stock.attributes',['id'=>$id]) !!}"  aria-expanded="false">Product Variants Without Stock </a></li>



    @endif
 
    <li class="{{ in_array(Route::currentRouteName(),['admin.products.upsell.related']) ? 'active' : '' }}"><a href="{!! route('admin.products.upsell.related',['id'=>$id]) !!}"  aria-expanded="false">Related Products </a></li>


</ul>