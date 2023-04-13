<div class="list-group">
    @foreach (App\Models\Category::orderBy('id', 'ASC')->whereNull('parent_id')->get(); as $parent)
    <a href="#main-{{ $parent->id }}" class="list-group-item list-group-item-action" data-toggle="collapse">
        <img src="{{ asset('images/categories/'.$parent->image ) }}" width="70" height="70" alt="" srcset="">
        {{ $parent->name }}
    </a>
<div class="collapse"

@if(Route::is('category.show'))
@if(App\Model\Category::prentOrNotCtegory($parent->id, $category->id))
active
@endif
@endif >
<div class="child-rows collapse" id="#main-{{ $parent->id }}">
        @foreach (App\Models\Category::orderBy('id', 'ASC')->where('parent_id', $parent->id)->get(); as $child)
        <a href="{{ route('category.show', $child->id) }}" class="list-group-item list-group-item-action" @if(Route::is('category.show')) @if($child->id == $catgeory->id) active @endif @endif>
            <img src="{{ asset('images/categories/'.$child->image ) }}" width="70" height="70" alt="" srcset="">
            {{ $child->name }}
        </a>
        @endforeach
    </div>
</div>

    @endforeach
</div>
