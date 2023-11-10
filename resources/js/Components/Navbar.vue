<template>
    <div class="navbar">
        <div class="navbar-content">
            <a class="btn normal-case text-xl text-orange-500">
                Lambda
            </a>
            <ul class="inline-flex items-center ps-2">
                <li><a class="inline-block py-3 px-2 border-b-2 border-transparent hover:text-orange-500 hover:border-orange-500 text-gray-500" href="#">Банлист</a></li>
                <li><a class="inline-block py-3 px-2 border-b-2 border-transparent hover:text-orange-500 hover:border-orange-500 text-gray-500" href="#">Статистика</a></li>
            </ul>
        </div>
        <ul class="navbar-content">
            <li><button class="btn focus:btn-outline focus:text-orange-500 normal-case text-orange-500 ml-2">Войти</button></li>
            <li><button class="btn bg-orange-500 normal-case text-white ml-2">Зарегистрироваться</button></li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Navbar",
    props: {

    }
}
</script>
