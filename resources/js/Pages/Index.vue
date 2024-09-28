<template>
    <div class="w-3/5">
        <GameServers/>
    </div>
    <div class="w-2/5">
        <News/>
    </div>
</template>

<script>
import GameServers from '@/Components/GameServers.vue';
import News from '@/Components/News.vue';
export default {
    components: { GameServers, News },
}
</script>
