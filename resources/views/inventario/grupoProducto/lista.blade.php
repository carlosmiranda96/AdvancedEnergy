<tr>
                            <th>Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($grupo as $item)
                        <tr>
                            <td>{{$item->grupo}}</td>
                            <td>
                                <form id="frmeliminar{{$item->id}}" method="post" action="{{route('grupo.destroy',$item->id)}}" class="form-inline">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-sm btn-warning" href="{{ route('grupo.edit',$item->id) }}"><i class="fas fa-edit"></i></a>
                                <a onclick="eliminar('{{$item->id}}')" class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash-alt"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($grupo->count()==0)
                        <tr>
                            <td colspan="5" class="text-center">No hay datos</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $grupo->links() }}
        </div>
    </div>
</div>
@stop