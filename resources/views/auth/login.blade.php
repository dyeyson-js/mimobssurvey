@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="container is-fullhd">
            <div class="columns is-centered">
                <div class="column is-one-third">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title is-centered">
                                ADMININSTRATOR LOGIN
                            </p>
                        </header>
                        <div class="card-content">
                            <form>
                                <div class="field">
                                    <label class="label">Username</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="text" placeholder="Text input" value="bulma">
                                        <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Username</label>
                                    <div class="control has-icons-left">
                                        <input class="input" type="password" placeholder="Text input" value="bulma">
                                        <span class="icon is-small is-left">
                                        <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="control">
                                    <button class="button is-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
