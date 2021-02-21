 <div class="product_thumb">


                                                    @if(!empty($product->productImages) && $product->productImages->count()>0)

                                                    <a class="primary_img" href="{{route('product.view',['slug'=>$product->slug,'id'=>$product->id])}}" >
                                                        <img @if($widget=="newproduct")) style="height:200px;" @else style="height: 120px;"  @endif
                                                            src="{{ productImage(!empty($product->productImages[0]->thumbnail) ?  $product->productImages[0]->thumbnail : "")}}" alt=""></a>
                                                   
                                                    @else
                                                    <a class="primary_img" href="product-details.html">
                                                        <img @if($widget=="newproduct") style="height:200px;" @endif
                                                            src="{{ productImage("")}}" alt=""></a>

                                                    @endif
</div>
