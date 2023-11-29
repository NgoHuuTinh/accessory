{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }} {{ Config::get('label.common.text.paginator') }}
<ul class="pagination pagination-sm no-margin pull-right">
    <li><a href="{{$paginator->withQueryString()->url(1)}}" class="{{ ($paginator->currentPage() == 1) ? 'is-disabled' : '' }}"><span class="fa fa-angle-double-left"></span></a> </li>
    <li><a href="{{$paginator->withQueryString()->previousPageUrl()}}" class="{{ ($paginator->currentPage() == 1) ? 'is-disabled' : '' }}"><span class="fa fa-angle-left"></span></a> </li>
    <li><a href="{{$paginator->withQueryString()->nextPageUrl()}}" class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'is-disabled' : '' }}"><span class="fa fa-angle-right"></span></a></li>
    <li><a href="{{$paginator->withQueryString()->url($paginator->lastPage())}}" class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'is-disabled' : '' }}"><span class="fa fa-angle-double-right"></span></a></li>
</ul>
