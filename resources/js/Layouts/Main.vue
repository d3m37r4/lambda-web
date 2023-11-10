<template>
    <div class="max-w-screen-xl mx-auto h-screen grid grid-rows-layout">
        <Navbar/>
        <div>
            <Breadcrumbs/>
            <main class="lg:flex">
                <div class="w-3/5">
                    <!-- Card 1 -->
                    <div class="bg-base-200 rounded-box p-4 mb-4 flex">
                        <div class="flex-shrink-0">
                            <img src="https://steamuserimages-a.akamaihd.net/ugc/938339513171723292/84874C0CBCEA963A99EA9656FF85C5AF0719E420/" alt="Map 1" class="h-full w-48 object-cover rounded">
                        </div>
                        <div class="ml-4 flex flex-col justify-between">
                            <div class="flex items-center mb-2">
                                <div class="bg-green-500 w-4 h-4 flex items-center justify-center rounded mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.636 4.575a.75.75 0 010 1.06 9 9 0 000 12.729.75.75 0 01-1.06 1.06c-4.101-4.1-4.101-10.748 0-14.849a.75.75 0 011.06 0zm12.728 0a.75.75 0 011.06 0c4.101 4.1 4.101 10.749 0 14.85a.75.75 0 11-1.06-1.061 9 9 0 000-12.728.75.75 0 010-1.06zM7.757 6.696a.75.75 0 010 1.061 6 6 0 000 8.485.75.75 0 01-1.06 1.061 7.5 7.5 0 010-10.607.75.75 0 011.06 0zm8.486 0a.75.75 0 011.06 0 7.5 7.5 0 010 10.607.75.75 0 01-1.06-1.06 6 6 0 000-8.486.75.75 0 010-1.06zM9.879 8.818a.75.75 0 010 1.06 3 3 0 000 4.243.75.75 0 11-1.061 1.06 4.5 4.5 0 010-6.363.75.75 0 011.06 0zm4.242 0a.75.75 0 011.061 0 4.5 4.5 0 010 6.364.75.75 0 01-1.06-1.06 3 3 0 000-4.244.75.75 0 010-1.06zM10.875 12a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <h2 class="text-gray-400 text-xl font-bold">Counter Strike Server 1</h2>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <div class="mr-4">
                                    <p>Адрес: 123.456.789.1:27015</p>
                                    <p>Регион: Europe</p>
                                    <p>Пинг: 30 ms</p>
                                </div>
                                <div>
                                    <p>Мод: Zombie Mod</p>
                                    <p>Карта: cs_italy</p>
                                    <p>Игроки: 24/32</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-base-200 rounded-box p-4 mb-4 flex">
                        <div class="flex-shrink-0">
                            <img src="https://steamuserimages-a.akamaihd.net/ugc/938339513171730971/F265E84437CB35A797541C00EC20DF42A419129B/" alt="Map 2" class="h-full w-48 object-cover rounded">
                        </div>
                        <div class="ml-4 flex flex-col justify-between">
                            <div class="flex items-center mb-2">
                                <div class="bg-green-500 w-4 h-4 flex items-center justify-center rounded mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.651a3.75 3.75 0 010-5.303m5.304 0a3.75 3.75 0 010 5.303m-7.425 2.122a6.75 6.75 0 010-9.546m9.546 0a6.75 6.75 0 010 9.546M5.106 18.894c-3.808-3.808-3.808-9.98 0-13.789m13.788 0c3.808 3.808 3.808 9.981 0 13.79M12 12h.008v.007H12V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-gray-400 text-xl font-bold">Counter Strike Server 2</h2>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <div class="mr-4">
                                    <p>Адрес: 123.456.789.2:27015</p>
                                    <p>Регион: North America</p>
                                    <p>Пинг: 40 ms</p>
                                </div>
                                <div>
                                    <p>Мод: Public</p>
                                    <p>Карта: cs_mansion</p>
                                    <p>Игроки: 18/32</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-base-200 rounded-box p-4 mb-4 flex">
                        <div class="flex-shrink-0">
                            <img src="https://steamuserimages-a.akamaihd.net/ugc/771724021898742152/3FAE420233A940A966B41CD934A52DFBE1ED9E08/" alt="Map 3" class="h-full w-48 object-cover rounded">
                        </div>
                        <div class="ml-4 flex flex-col justify-between">
                            <div class="flex items-center mb-2">
                                <div class="bg-green-500 w-4 h-4 flex items-center justify-center rounded mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.348 14.651a3.75 3.75 0 010-5.303m5.304 0a3.75 3.75 0 010 5.303m-7.425 2.122a6.75 6.75 0 010-9.546m9.546 0a6.75 6.75 0 010 9.546M5.106 18.894c-3.808-3.808-3.808-9.98 0-13.789m13.788 0c3.808 3.808 3.808 9.981 0 13.79M12 12h.008v.007H12V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-gray-400 text-xl font-bold">Counter Strike Server 3</h2>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <div class="mr-4">
                                    <p>Адрес: 123.456.789.3:27015</p>
                                    <p>Регион: Asia</p>
                                    <p>Пинг: 50 ms</p>
                                </div>
                                <div>
                                    <p>Мод: Gun Game</p>
                                    <p>Карта: de_dust</p>
                                    <p>Игроки: 28/32</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Show All Servers Button -->
                    <div class="flex justify-center mt-4">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 rounded-box w-full">
                            Показать все игровые серверы
                        </button>
                    </div>
                    <!--    post    -->
    <!--                <section class="px-2">-->

    <!--                    <a class="block mb-10" href="">-->
    <!--                        <div class="flex">-->
    <!--                            <div>-->
    <!--                                <h3 class="mb-2 text-gray-400 font-bold text-2xl">Что такое Lorem Ipsum?</h3>-->
    <!--                                <p class="text-gray-400">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->

    <!--                    <a class="block mb-10" href="">-->
    <!--                        <div class="flex">-->
    <!--                            <div>-->
    <!--                                <h3 class="mb-2 text-gray-400 font-bold text-2xl">Почему он используется?</h3>-->
    <!--                                <p class="text-gray-400">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->

    <!--                    <a class="block mb-10" href="">-->
    <!--                        <div class="flex">-->
    <!--                            <div>-->
    <!--                                <h3 class="mb-2 text-gray-400 font-bold text-2xl">Откуда он появился?</h3>-->
    <!--                                <p class="text-gray-400">Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги "de Finibus Bonorum et Malorum" ("О пределах добра и зла"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, "Lorem ipsum dolor sit amet..", происходит от одной из строк в разделе 1.10.32-->
    <!--                                    Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 "de Finibus Bonorum et Malorum" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.</p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </a>-->
    <!--                </section>-->

                    <!--    pagination    -->
    <!--                <div class="mt-20 mb-10">-->
    <!--                    <ul class="join flex justify-center">-->
    <!--                        <li class="join-item btn"><a href="">Назад</a></li>-->
    <!--                        <li class="join-item btn"><a href="">1</a></li>-->
    <!--                        <li class="join-item btn"><a href="">2</a></li>-->
    <!--                        <li class="join-item btn btn-active"><a href="">3</a></li>-->
    <!--                        <li class="join-item btn"><a href="">4</a></li>-->
    <!--                        <li class="join-item btn"><a href="">5</a></li>-->
    <!--                        <li class="join-item btn"><a href="">Далее</a></li>-->
    <!--                    </ul>-->
    <!--                </div>-->
                </div>
                <div class="w-2/5">
                    <!-- post-->
                    <section class="bg-base-200 rounded-box p-4 ml-4">
                        <a class="block mb-10 border-b" href="">
                            <div class="flex">
                                <div>
                                    <h3 class="mb-2 text-gray-400 font-bold text-2xl">Что такое Lorem Ipsum?</h3>
                                    <p class="text-gray-400">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>
                                </div>
                            </div>
                        </a>

                        <a class="block mb-10" href="">
                            <div class="flex">
                                <div>
                                    <h3 class="mb-2 text-gray-400 font-bold text-2xl">Почему он используется?</h3>
                                    <p class="text-gray-400">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</p>
                                </div>
                            </div>
                        </a>

                        <a class="block mb-10" href="">
                            <div class="flex">
                                <div>
                                    <h3 class="mb-2 text-gray-400 font-bold text-2xl">Откуда он появился?</h3>
                                    <p class="text-gray-400">Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги "de Finibus Bonorum et Malorum" ("О пределах добра и зла"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, "Lorem ipsum dolor sit amet..", происходит от одной из строк в разделе 1.10.32
                                        Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 "de Finibus Bonorum et Malorum" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.</p>
                                </div>
                            </div>
                        </a>
                    </section>
                </div>
            </main>
        </div>
        <Footer/>
    </div>
</template>

<script>
import Navbar from '@/Components/Navbar.vue'
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Footer from '@/Components/Footer.vue'
export default {
    components: { Navbar, Breadcrumbs, Footer }
}
</script>
