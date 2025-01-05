<script setup>
import { Link } from '@inertiajs/vue3';
import DarkModeToggleSwitch from '@/Components/DarkModeToggleSwitch.vue';
import LocaleSwitcher from "@/Components/LocaleSwitcher.vue";
import Button from "@/Components/Buttons/Button.vue";
import RoleBadge from "@/Components/RoleBadge.vue";
</script>

<template>
    <div class="navbar">
        <div class="space-x-4">
            <Link href="/" class="btn normal-case text-xl text-orange-500">Lambda</Link>
            <ul class="inline-flex items-center space-x-2">
                <li><a href="#" class="hover:text-orange-500">Банлист</a></li>
                <li><a href="#" class="hover:text-orange-500">Статистика</a></li>
            </ul>
        </div>
        <div class="space-x-2">
            <DarkModeToggleSwitch />
            <LocaleSwitcher />
            <div v-if="$page.props.auth.user" class="dropdown">
                <Button tabindex="0" class="btn navbar-content--btn">
                    {{ $t('profile') }}
                    <svg class="fill-current h-5 w-5" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </Button>
                <div tabindex="0" class="dropdown-content dropdown-content--profile">
                    <div class="flex items-center">
                        <div class="avatar placeholder px-2">
                            <div class="rounded-full w-16 ring-1 ring-green-500">
                                <img src="https://avatars.githubusercontent.com/u/26052038?v=4" :alt="$page.props.auth.user.login"/>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <p class="truncate">
                                {{ $page.props.auth.user.login }}
                            </p>
                            <RoleBadge :role="$page.props.auth.user.role.name" />
                        </div>
                    </div>
                    <nav class="grid space-y-1 pt-2">
                        <Button :link="route('dashboard.index')" class="btn dropdown-content--btn">
                            <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
                                <path d="M3 5C3 3.89543 3.89543 3 5 3H9C10.1046 3 11 3.89543 11 5V9C11 10.1046 10.1046 11 9 11H5C3.89543 11 3 10.1046 3 9V5ZM9 5H5V9H9V5Z"/><path d="M3 15C3 13.8954 3.89543 13 5 13H9C10.1046 13 11 13.8954 11 15V19C11 20.1046 10.1046 21 9 21H5C3.89543 21 3 20.1046 3 19V15ZM9 15H5V19H9V15Z"/><path d="M13 5C13 3.89543 13.8954 3 15 3H19C20.1046 3 21 3.89543 21 5V9C21 10.1046 20.1046 11 19 11H15C13.8954 11 13 10.1046 13 9V5ZM19 5H15V9H19V5Z"/><path d="M13 15C13 13.8954 13.8954 13 15 13H19C20.1046 13 21 13.8954 21 15V19C21 20.1046 20.1046 21 19 21H15C13.8954 21 13 20.1046 13 19V15ZM19 15H15V19H19V15Z"/>
                            </svg>
                            <span class="font-normal">
                                {{ $t('dashboard.page.main.title') }}
                            </span>
                        </Button>
                        <Button :link="route('dashboard.index')" class="btn dropdown-content--btn" >
                            <svg class="fill-none h-5 w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            </svg>
                            <span class="font-normal">
                                {{ $t('profile') }}
                            </span>
                        </Button>
                        <Button class="btn dropdown-content--btn">
                            <svg class="fill-none h-5 w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            </svg>
                            <span class="font-normal">
                                {{ $t('game-accounts') }}
                            </span>
                        </Button>
                    </nav>
                    <div class="pt-2">
                        <Button :link="route('logout')" method="post" as="button" class="btn dropdown-content--btn">
                            <svg class="fill-none h-5 w-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M9 12h12l-3 -3"></path><path d="M18 15l3 -3"></path>
                            </svg>
                            <span class="font-normal">
                                {{ $t('auth.exit') }}
                            </span>
                        </Button>
                    </div>
                </div>
            </div>
            <div v-else class="space-x-2">
                <Link :href="route('login')" class="btn btn-neutral">
                    {{ $t('auth.sign_in') }}
                </Link>
                <Link :href="route('register')" class="btn bg-orange-500 text-white hover:bg-orange-600">
                    {{ $t('auth.create_account') }}
                </Link>
            </div>
        </div>
    </div>
</template>
