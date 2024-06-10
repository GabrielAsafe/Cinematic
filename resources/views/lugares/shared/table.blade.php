<table class="table">
    <thead class="table-dark">
        <tr>
            <th>Fila</th>
            <th>Posição</th>
            @if ($showDetail)
                <th class="button-icon-col"></th>
            @endif
            @if ($showEdit)
                <th class="button-icon-col"></th>
            @endif
            @if ($showDelete)
                <th class="button-icon-col"></th>
            @endif
            @if ($showAddCart ?? false)
                <th class="button-icon-col"></th>
            @endif
            @if ($showRemoveCart ?? false)
                <th class="button-icon-col"></th>
            @endif



        </tr>
    </thead>
    <tbody>
        @foreach ($lugares as $lugar)
            <tr>
                <td>{{ $lugar->fila }}</td>
                <td>{{ $lugar->posicao }}</td>
                @if ($showDetail)
                    <td class="button-icon-col"><a class="btn btn-secondary"
                            href="{{ route('lugares.show', ['lugare' => $lugar]) }}">
                            <i class="fas fa-eye"></i></a></td>
                @endif
                @if ($showEdit)
                    <td class="button-icon-col"><a class="btn btn-dark"
                            href="{{ route('lugares.edit', ['lugare' => $lugar]) }}">
                            <i class="fas fa-edit"></i></a></td>
                @endif
                @if ($showDelete)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('lugares.destroy', ['lugare' => $lugar]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                @endif

                @if ($showAddCart ?? false)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('cart.add',['lugar' => $lugar])  }}"><!--alterei essa e a cena de baixo-->
                            @csrf
                            <button type="submit" name="addToCart" class="btn btn-success">
                                <i class="fas fa-plus"></i></button>
                        </form>
                    </td>
                @endif
                @if ($showRemoveCart ?? false)
                    <td class="button-icon-col">
                        <form method="POST" action="{{ route('cart.remove',  ['lugar' => $lugar])  }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="removeFromCart" class="btn btn-danger">
                                <i class="fas fa-remove"></i></button>
                        </form>
                    </td>
                @endif


            </tr>
        @endforeach
</table>
