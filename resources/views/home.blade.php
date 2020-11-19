@extends('layouts.app')

@section('content')
    <div class="container is-fluid box">
            <div class="row is-multiline">
                <div class="loading column is-4 is-offset-4" v-if="loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <br>
                <div class="col-md-3 image__item" v-for="file in files" >
                    <div class="card image">
                        <div class="card-image">
                            <button type="button" class="btn btn-danger delete-file" title="Delete" @click="prepareToDelete(file)">Delete</button>
                            <figure class="image" @click="showModal(file)">
                                <img v-if="file !== editingFile" src=""  :src="'{{ asset('storage/' . Auth::user()->name . '_' . Auth::id()) }}' + '/image/' + file.thumbnail_image" :alt="file.original_image">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
