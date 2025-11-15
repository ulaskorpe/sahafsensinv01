<div class="row px-xl-5">
    <div class="col">
        <div class="bg-light p-30">
            <div class="nav nav-tabs mb-4">
                <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Ürün Açıklaması</a>

                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-comments">Yorumlar ( {{  $product->comments()->count()}} )</a>
                @if(count($product->bids()->get()))
                <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-bids">Teklifler ( {{  $product->bids()->count()}} )</a>
                @endif
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3"></h4>
                    @php
                        echo $product['description']
                    @endphp

                </div>

                <div class="tab-pane fade" id="tab-pane-comments">

                    <div id="product_comments"></div>
                </div>

                <div class="tab-pane fade" id="tab-pane-bids">
                       <div id="product_bids"></div>
                </div>
            </div>
        </div>
    </div>
</div>
