@extends('admin.layouts.empty')

@section('content')
    <div id="login-content"></div>
    <template id="Login">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" v-model="user.username"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" v-model="user.password"/>
                </div>
                <button class="btn btn-success" @click="onSubmit">Submit</button>
            </div>
        </div>
    </template>
@stop

@push('vue')
    <script>
        Vue.createApp({
            template: '#Login',
            data() {
                return {
                    user: {password: '123456', username: 'admin', _token: '{{csrf_token()}}'}
                }
            },
            methods: {
                async onSubmit() {
                    await API.AUTH.LOGIN(this.user)
                }
            }
        }).mount('#login-content')
    </script>
@endpush
