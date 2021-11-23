<div class="Header_Bottom_Rt">
    <div class="search">
        <span class="SrchHvr">
            <input type="text" name="search" wire:model="searchTerm"  class="SrchHdr form-control" placeholder="Search Products Here" />

            @if (count($products) > 0)
        
            <ul style="margin-left:4%;margin-top:10%;position :absolute;z-index:99999;width:500px;box-shadow: #b3c0e7 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 5px 5px;">
                
                <li style="background:white; ">
                    <p style="padding: 2%"><b>{{ count($products) }} Results</b></p>
                </li>

                @foreach ($products as $product)
                <li style="">
                    <a href="{{ route('guest.product.show', $product->id) }}" style="color: black;text-decoration:none;">
                        <div class="row" style="background: white;padding:0px;margin:0px">
                            <div class="col-sm-8">
                                <b>{{ $product->name }}</b>
                            </div>
                            <div class="col-sm-4">
                                {{ $product->created_at->diffForHumans() }}
                            </div>
                            <div class="col-sm-12">
                                {{ substr($product->description, 0, 100) }}
                                <hr>
                            </div>
                        </div> 
                    </a>
                </li>
                @endforeach
            
            </ul>
            @endif
        </span>
    </div>
</div>

