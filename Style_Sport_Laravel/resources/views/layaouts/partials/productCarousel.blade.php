@foreach ($Product as $P)
<div class="card" style="width: 18rem;">
@foreach ($imgProduct as $img)
    @if ($img->id_producto == $P->id)
    <img src="{{asset('storage/imgs/'.$img->imagen)}}">
    @endif
@endforeach
<div class="card-body">
    <h5 class="card-title">{{$P->nombre}}</h5>
    <p class="card-text">{{$P->descripcion}}</p>
    <a href="#" class="btn btn-primary">Ver mas</a>
  </div>
</div>
@endforeach