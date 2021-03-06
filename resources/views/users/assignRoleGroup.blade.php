{{--dd($users->toArray())--}}

@extends('layouts.admin')

@section('breadcrumb')
{!! $breadcrumb->add('Gruppi','/admin/groups')->add('Assegna ruoli')
    ->setTcrumb($group->name)
    ->render() !!}
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ruoli diponibili</h3>
                    </div>
                    {!!
                        $list->setModel($roleDis)
                            ->columns(['id','name'=>'Nome','azioni'])
                            ->showActions(false)
                            ->showAll(false)
                            ->setPrefix('RTYX_')
                            ->customizes('azioni', function($row) use($group) {
                                return "<a href=\"/admin/groups/". $group->id."/addRole/".$row['id']."\" class=\"btn btn-warning btn-xs pull-right\">Assegna</a>";
                            })->render()
                    !!}
                </div> <!-- /.box -->
            </div> <!-- /.col -->
            <div class="col-md-7">

                {!!
                    $composer->boxNavigator([
                        'type'=> 'primary',
                        'title'=>$group->id ." - ".$group->name,
                        'listMenu'=>[
                            'Lista gruppi'=>url('/admin/groups'),
                            'divider'=>"divider",
                            'Modifica'=>url('/admin/groups/edit',$group->id),
                            'Assegna utenti'=>url('/admin/groups/assign',$group->id),
                            'Assegna permessi'=>url('/admin/groups/assignPerm',$group->id),
                            'Profilo'=>url('/admin/groups/profile',$group->id),
                        ],
                        'urlNavPre'=>url('/admin/groups/assignRole',$pag['preid']->id),
                        'urlNavNex'=>url('/admin/groups/assignRole',$pag['nexid']->id),
                        ])->render()
                 !!}

                <div class="box box-default">
                    {!!
                         $list->setModel($roleAss)
                            ->columns(['id','name'=>'Nome','azioni'])
                            ->showActions(false)
                            ->showAll(false)
                            ->setPrefix('HGYU_')
                            ->customizes('azioni', function($row) use($group) {
                                return "<a href=\"/admin/groups/". $group->id."/removeRole/".$row['id']."\" class=\"btn btn-danger btn-xs pull-right\">Cancella</a>";
                            })->render()
                     !!}
                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section>
    <!-- /.content -->
@stop
@push('scripts')
    <script>
        $("#RTYX_xpage").change(function () {
            $("#RTYX_xpage-form").submit();
        });
        $("#HGYU_xpage").change(function () {
            $("#HGYU_xpage-form").submit();
        });
    </script>
@endpush