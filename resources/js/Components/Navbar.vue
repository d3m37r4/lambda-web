<template>
    <div class="navbar">
        <div>
            <Link href="/" class="btn normal-case text-xl text-orange-500">Lambda</Link>
            <ul class="inline-flex items-center ps-2">
                <li><a href="#" class="px-2 hover:text-orange-500">Банлист</a></li>
                <li><a href="#" class="px-2 hover:text-orange-500">Статистика</a></li>
            </ul>
        </div>
        <div>
            <DarkModeToggleSwitch />
            <template v-if="$page.props.auth.user">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost normal-case ml-2">
                        Профиль
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                    </label>
                    <div tabindex="0" class="dropdown-content z-[1] text-sm bg-base-300 p-4 shadow drop-shadow-xl divide-y divide-neutral rounded-box w-52">
                        <div class="flex items-center">
                            <div class="flex items-center mr-auto space-x-2 pb-2">
                                <div class="avatar placeholder">
                                    <div class="rounded-full w-16 ring-1 ring-green-500">
                                        <img src="https://avatars.githubusercontent.com/u/26052038?v=4" :alt="$page.props.auth.user.login"/>
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <p class="truncate">{{ $page.props.auth.user.login }}</p>
                                    <div class="badge badge-secondary rounded">{{ $page.props.auth.user.role }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <nav class="grid gap-3">
                                <Link :href="route('dashboard.index')" class="flex items-center space-x-2 hover:text-orange-500">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M3 5C3 3.89543 3.89543 3 5 3H9C10.1046 3 11 3.89543 11 5V9C11 10.1046 10.1046 11 9 11H5C3.89543 11 3 10.1046 3 9V5ZM9 5H5V9H9V5Z"/><path d="M3 15C3 13.8954 3.89543 13 5 13H9C10.1046 13 11 13.8954 11 15V19C11 20.1046 10.1046 21 9 21H5C3.89543 21 3 20.1046 3 19V15ZM9 15H5V19H9V15Z"/><path d="M13 5C13 3.89543 13.8954 3 15 3H19C20.1046 3 21 3.89543 21 5V9C21 10.1046 20.1046 11 19 11H15C13.8954 11 13 10.1046 13 9V5ZM19 5H15V9H19V5Z"/><path d="M13 15C13 13.8954 13.8954 13 15 13H19C20.1046 13 21 13.8954 21 15V19C21 20.1046 20.1046 21 19 21H15C13.8954 21 13 20.1046 13 19V15ZM19 15H15V19H19V15Z"/>
                                    </svg>
                                    <span>Панель управления</span>
                                </Link>
                                <Link :href="route('profile.edit')" class="flex items-center space-x-2 hover:text-orange-500">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>
                                    <span>Профиль</span>
                                </Link>
                                <a href="/" class="flex items-center space-x-2 hover:text-orange-500">
                                    <svg class="w-5 h-5" viewBox="0 0 35 35" fill="currentColor">
                                        <path d="M13.2,18.456H8.475a1.25,1.25,0,1,1,0-2.5H13.2a1.25,1.25,0,0,1,0,2.5Z"/>
                                        <path d="M10.839,20.82a1.25,1.25,0,0,1-1.25-1.25V14.841a1.25,1.25,0,0,1,2.5,0V19.57A1.25,1.25,0,0,1,10.839,20.82Z"/>
                                        <path d="M20.954,18.515a1.251,1.251,0,0,0,0-2.5,1.251,1.251,0,0,0,0,2.5Z"/>
                                        <path d="M23.8,15.67a1.251,1.251,0,0,0,0-2.5,1.251,1.251,0,0,0,0,2.5Z"/>
                                        <path d="M23.68,21.241a1.251,1.251,0,0,0,0-2.5,1.251,1.251,0,0,0,0,2.5Z"/>
                                        <path d="M26.525,18.4a1.251,1.251,0,0,0,0-2.5,1.251,1.251,0,0,0,0,2.5Z"/>
                                        <path d="M28.886,34.75a4.9,4.9,0,0,1-4.752-3.663l-1.4-4.1a20.448,20.448,0,0,1-10.436-.068l-1.456,4.257a4.725,4.725,0,0,1-1.717,2.549,4.905,4.905,0,0,1-7.9-3.836V19.2c0-.31.038-.868.054-1.08l-.052-.945A10.494,10.494,0,0,1,11.693,6.641a10.351,10.351,0,0,1,3.728.686,3.821,3.821,0,0,0,1.373.235h1.412a3.751,3.751,0,0,0,1.353-.227A10.32,10.32,0,0,1,23.5,6.643,10.674,10.674,0,0,1,33.781,17.42V29.892A4.881,4.881,0,0,1,28.886,34.75ZM23.5,24.141a1.253,1.253,0,0,1,1.183.846l1.841,5.384a2.438,2.438,0,0,0,2.359,1.879,2.379,2.379,0,0,0,2.395-2.358V17.42a8.163,8.163,0,0,0-7.822-8.277,7.78,7.78,0,0,0-3,.524h0a6.249,6.249,0,0,1-2.255.395H16.794a6.311,6.311,0,0,1-2.269-.4,7.858,7.858,0,0,0-2.832-.52,7.978,7.978,0,0,0-7.974,7.965l.054.955a1.9,1.9,0,0,1,0,.2c-.011.141-.05.66-.05.938V29.892a2.406,2.406,0,0,0,3.871,1.86,2.35,2.35,0,0,0,.855-1.29l1.869-5.475a1.251,1.251,0,0,1,1.59-.777c.062.02,6.155,2.075,11.123.025A1.247,1.247,0,0,1,23.5,24.141ZM20.01,8.5h0Z"/>
                                        <path d="M18.294,7.261a1.23,1.23,0,0,1-.105-1.184,1.891,1.891,0,0,1,.874-1.04A4.97,4.97,0,0,1,22.7,4.874a8.184,8.184,0,0,0,4.595.142A3.683,3.683,0,0,0,29.854,1.5,1.278,1.278,0,0,0,28.6.25a1.262,1.262,0,0,0-1.25,1.25c.066,1.244-1.558,1.378-2.5,1.266-1.574-.186-3.049-.792-4.663-.617a5.182,5.182,0,0,0-3.917,2.183,3.982,3.982,0,0,0-.137,4.19c.836,1.372,3,.117,2.158-1.261Z"/>
                                    </svg>
                                    <span>Игровые аккаунты</span>
                                </a>
                            </nav>
                        </div>
                        <div class="pt-2">
                            <Link :href="route('logout')" method="post" class="flex items-center space-x-2 hover:text-orange-500">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                    <path d="M9 12h12l-3 -3"></path>
                                    <path d="M18 15l3 -3"></path>
                                </svg>
                                <span>{{ ('Выход') }}</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <Link :href="route('login')" class="btn focus:btn-outline focus:text-orange-500 normal-case text-orange-500 ml-2">Войти</Link>
                <Link :href="route('register')" class="btn bg-orange-500 normal-case text-white ml-2">Зарегистрироваться</Link>
            </template>
        </div>
    </div>
</template>

<script>
import DarkModeToggleSwitch from '@/Components/DarkModeToggleSwitch.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: { DarkModeToggleSwitch, Link }
}
</script>
