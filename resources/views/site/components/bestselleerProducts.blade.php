<figcaption class="product_content">
                                                    <h4 class="product_name"><a href="{{route('product.view',['slug'=>$product->slug,'id'=>$product->id])}}">{{$product->name}}</a></h4>
                                                    @if(!empty($product->category->name))
                                                    <p><a href="{{route('products',['category'=>'true','categoryid'=>$product->category->id])}}">{{!empty($product->category->name) ? $product->category->name : ""}}</a></p>

                                                            @endif

                                                            <div class="price_box">

                                                                    <span class="current_price">${{($product->unitPrice-$product->discount_price )}}</span>
                                                                    @if($product->discount_price > 0)
                                                                    <span class="old_price">${{$product->unitPrice}}</span>
                                                                    @endif

                                                                </div>
                                                                <button class="cart-button btn-sm btn-primary" type="button" data-tippy="Add to cart"
                                                                data-tippy-placement="top"
                                                                data-tippy-arrow="true"
                                                                onclick="addtocart({{$product->id}})">Add to cart
                                              </button>


                                                </figcaption>
