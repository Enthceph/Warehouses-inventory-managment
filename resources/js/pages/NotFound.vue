<script setup>
function randomIntFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min)
}

let rand = randomIntFromInterval(1, 4)

let imgPath = computed(
    () => `${import.meta.env.VITE_ASSETS_PATH}/NotFound${rand}.jpg`)

</script>

<template>
    <div class="not-found">
        <div class="text">
            <span>
                404 | NotFound <br><br>
                <router-link to="/organisation">
                    go back?
                </router-link>
            </span>
        </div>
        <img :src="imgPath" alt="NotFound">
    </div>
</template>

<style scoped>
.not-found {
    display:               grid;
    grid-template-columns: 1fr 1fr;
    height:                100vh;
    width:                 100%;
}

.text {
    display:     grid;
    place-items: center;
    text-align:  center;
}

.text a {
    color: var(--main-blue);
}

img {
    height:     100vh;
    object-fit: cover;
}
</style>
