@if ($paginator->hasPages())
    <div class="paginating-container pagination-solid">
        <ul class="pagination">
        @if ( ! $paginator->onFirstPage())
            {{-- First Page Link --}}
            <li class="prev"><a
            
            wire:click="gotoPage(1)"
            >
            <<
            </a></li>
            @if($paginator->currentPage() > 2)
            {{-- Previous Page Link --}}
           <li  class="prev"><a
               
                wire:click="previousPage"
            >
            <
            </a></li>
            @endif
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <!--  Use three dots when current page is greater than 3.  -->
                    @if ($paginator->currentPage() > 3 && $page === 2)
                        <div class="text-dark">
                            <span class="font-bold">.</span>
                            <span class="font-bold">.</span>
                            <span class="font-bold">.</span>
                        </div>
                    @endif

                    <!--  Show active page two pages before and after it.  -->
                    @if ($page == $paginator->currentPage())
                       <li class="active"><a>{{ $page }}</a></li>
                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2)
                       <li class="active"><a wire:click="gotoPage({{$page}})">{{ $page }}</a></li>
                    @endif

                    <!--  Use three dots when current page is away from end.  -->
                    @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                        <div class="text-dark">
                            <span class="font-bold">.</span>
                            <span class="font-bold">.</span>
                            <span class="font-bold">.</span>
                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if($paginator->lastPage() - $paginator->currentPage() >= 2)
               <li class="next"><a 
                wire:click="nextPage"
                rel="next">
                >
                </a></li>
            @endif
          <li class="next"> <a               
                wire:click="gotoPage({{ $paginator->lastPage() }})"
            >
            >>
            </a></li>
        @endif
    </ul>
    </div>
@endif