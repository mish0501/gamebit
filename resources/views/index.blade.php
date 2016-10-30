@extends('layouts.app')

@section('content')
<template v-if="$route.path === '/'">
    <div class="container">
        <div class="page-header text-center">
            <h2 class="description">Digital version of your childhood games!</h2>
            @if (Auth::guest())
            <a href="{{ url('/register') }}" class="btn btn-primary">Register now!</a>
            @endif
            <div class="icons">
                <svg class="paper-plane" xmlns="http://www.w3.org/2000/svg" viewBox="-401 253 64 57"><path fill="#CCC" d="M-374.3 302.3l-6.7 6.7v-10"/><path fill="#EEE" d="M-337 253l-22 57-22-11v10l-8-16-12-8"/><path fill="#DDD" d="M-389 293l8 16v-10l44-46"/></svg>
                <svg class="controller" xmlns="http://www.w3.org/2000/svg" viewBox="262.1 124.5 435.8 311.1"><path d="M598.5 128.3c-43.7-12.9-57.4 11.6-118.5 11.6s-74.8-24.6-118.5-11.6C317.8 141.2 296 187 275.4 273c-20.6 86.1-16.8 148.2 7.5 159.8 24.3 11.6 51.7-15 77.9-47.8 21.2-25.7 31.8-27.3 119.1-27.3 87.2 0 96.3.7 119.1 27.3 26.2 32.8 53.6 59.3 77.9 47.8 24.3-11.6 28.1-73.7 7.5-159.8-20.5-86-42.4-131.7-85.9-144.7zM355.7 287.4c-21.1 0-38.2-17.2-38.2-38.5 0-21.2 17.1-38.5 38.2-38.5s38.2 17.3 38.2 38.5-17.1 38.5-38.2 38.5zm176.5-19.6c-10.3 0-18.8-8.5-18.8-18.9 0-10.4 8.5-18.9 18.8-18.9 10.4 0 18.9 8.5 18.9 18.9-.1 10.5-8.5 18.9-18.9 18.9zm41.1 41.3c-10.3 0-18.8-8.5-18.8-18.9 0-10.5 8.5-18.9 18.8-18.9 10.4 0 18.9 8.5 18.9 18.9-.1 10.5-8.5 18.9-18.9 18.9zm0-82.6c-10.3 0-18.8-8.5-18.8-18.9 0-10.4 8.5-18.9 18.8-18.9 10.4 0 18.9 8.5 18.9 18.9-.1 10.4-8.5 18.9-18.9 18.9zm41.1 41.3c-10.4 0-18.8-8.5-18.8-18.9 0-10.4 8.5-18.9 18.8-18.9s18.8 8.5 18.8 18.9c0 10.5-8.4 18.9-18.8 18.9z" fill="#EEE"/><g stroke-width=".22" stroke-miterlimit="1.414"><circle cx="538.7" cy="252.1" r="23.9" fill="#4C90C3" stroke="#0A7CDE"/><circle cx="611.5" cy="252.1" r="23.9" fill="#D8953A" stroke="#B87616"/><circle cx="574.4" cy="211.7" r="23.9" fill="#C2444E" stroke="#B82016"/><circle cx="574.7" cy="290.8" r="23.9" fill="#52C557" stroke="#16B835"/></g><circle cx="357.8" cy="248.7" r="38.6" fill="#6E7872"/><circle cx="357.8" cy="248.7" r="33.8" fill="#4A4B4B"/></svg>
            </div>
        </div>

        <div class="games">
            <h2>Games</h2>
            <router-link class="game text-center" :to="{ name: 'game', params: { id: 1 } }">
                <svg class="sheet" xmlns="http://www.w3.org/2000/svg" viewBox="-439 257 41 53"><path fill="#F4F4F4" d="M-412 257h-27v53h41v-53"/><g fill="#CCC"><path d="M-431 276.5h25c.6 0 1-.4 1-1s-.4-1-1-1h-25c-.6 0-1 .4-1 1s.4 1 1 1zM-406 282.5h-25c-.6 0-1 .4-1 1s.4 1 1 1h25c.6 0 1-.4 1-1s-.4-1-1-1zM-406 290.5h-25c-.6 0-1 .4-1 1s.4 1 1 1h25c.6 0 1-.4 1-1s-.4-1-1-1zM-406 298.5h-25c-.6 0-1 .4-1 1s.4 1 1 1h25c.6 0 1-.4 1-1s-.4-1-1-1zM-431 268.5h25c.6 0 1-.4 1-1s-.4-1-1-1h-25c-.6 0-1 .4-1 1s.4 1 1 1z"/></g></svg>
                <h3>Word Game</h3>
                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, qui. Deserunt ad facilis voluptatum quas totam distinctio quos, explicabo, nulla sequi ea placeat dolores officia quasi, adipisci eius excepturi. Perspiciatis!</h4>
            </router-link>
        </div>
        <div class="join-game">
            <h2>Join a game</h2>
            <join-game></join-game>
        </div>
    </div>
    <div class="footer text-left">
        <span>GameBit © 2016. All rights reserved</span>
    </div>
</template>
<div v-else class="container">
    <div class="row">
        <router-view ></router-view>
    </div>
</div>
@endsection
