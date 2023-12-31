<?php
namespace App\Traits;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;

trait CartTrait {

    public function ScanearCode($id, $cant = 1)
    {

        $product = Product::where('id', $id)->first();

        if($product == null || empty($product))
        {
                $this->emit('scan-notfound','El producto no está registrado');
        }  else {

                if($this->InCart($product->id))
                {
                        $this->IncreaseQuantity($product);
                        return;
                }

                if($product->stock <1)
                {
                        $this->emit('no-stock','Stock insuficiente');
                        return;
                }


                Cart::add($product->id, $product->product_name, $product->price, $cant);
                //Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();

                $this->emit('scan-ok','Producto agregado');               


        }

}


public function InCart($productId)
{
        $exist = Cart::get($productId);
        if($exist)
                return true;
        else
                return false;
}


public function IncreaseQuantity($product, $cant = 1)
{        
        $title ='';
        
        $exist = Cart::get($product->id);
        if($exist)
                $title = 'Cantidad actualizada';
        else
                $title ='Producto agregado';

        if($exist)
        {
                if($product->stock < ($cant + $exist->quantity))
                {
                        $this->emit('no-stock','Stock insuficiente');
                        return;
                }
        }


//        Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
        Cart::add($product->id, $product->product_name, $product->price, $cant);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', $title);

}


public function updateQuantity($product, $cant = 1)
{
        $title='';
                //$product = Product::find($productId);
        $exist = Cart::get($product->id);
        if($exist)
                $title = 'Cantidad actualizada';
        else
                $title ='Producto agregado';


        if($exist)
        {
                if($product->stock < $cant)
                {
                        $this->emit('no-stock','Stock insuficiente');
                        return;
                }
        }


        $this->removeItem($product->id);

        if($cant > 0)
        {
                Cart::add($product->id, $product->product_name, $product->price, $cant);
                //Cart::add($product->id, $product->name, $product->price, $cant, $product->image);

                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();

                $this->emit('scan-ok', $title);

        }       


}

public function removeItem($productId)
{
        Cart::remove($productId);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto eliminado');
}

public function decreaseQuantity($productId)
{
        $item = Cart::get($productId);
        //dd($item);
        Cart::remove($productId);
        
        // // si el producto no tiene imagen, mostramos una default
        //$img = (count($item->attributes) > 0 ? $item->attributes[0] : Product::find($productId));
        
        $newQty = ($item->quantity) - 1;
        //dd($newQty);
        if($newQty > 0)                 
                $data = Cart::add($item->id, $item->name, $item->price, $newQty);  
                //dd($data);              


        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad actualizada');
        


}

public function trashCart()
{
        Cart::clear();
        $this->efectivo =0;
        $this->change =0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Carrito vacío');

}


}