{{--dd($users->toArray())--}}

@extends('layouts.admin')

@section('breadcrumb')
    {!! $breadcrumb->add('Gruppi','/admin/groups')->add('Assegna utenti')
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
                        <h3 class="box-title">Utenti diponibili</h3>
                    </div>
                    {!!
                        $list->setModel($usersDis)
                            ->columns(['id','nome','cognome','azioni'])
                            ->showActions(false)
                            ->showAll(false)
                            ->setPrefix('RTYX_')
                            ->customizes('azioni', function($row) use($group) {
                                return "<a href=\"/admin/groups/". $group->id."/addUser/".$row['id']."\" class=\"btn btn-warning btn-xs pull-right\">Assegna</a>";
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
                            'Assegna permessi'=>url('/admin/groups/assignPerm',$group->id),
                            'Assegna ruoli'=>url('/admin/groups/assignRole',$group->id),
                            'Profilo'=>url('/admin/groups/profile',$group->id),
                        ],
                        'urlNavPre'=>url('/admin/groups/assign',$pag['preid']->id),
                        'urlNavNex'=>url('/admin/groups/assign',$pag['nexid']->id),
                        ])->render()
                 !!}

                <div class="box box-default">
                    {!!
                         $list->setModel($usersAss)
                            ->columns(['id','nome','cognome','azioni'])
                            ->showActions(false)
                            ->showAll(false)
                            ->setPrefix('HGYU_')
                            ->customizes('azioni', function($row) use($group) {
                                return "<a href=\"/admin/groups/". $group->id."/removeUser/".$row['id']."\" class=\"btn btn-danger btn-xs pull-right\">Cancella</a>";
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