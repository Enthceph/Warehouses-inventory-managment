<!--Страница - по сути полигон для теста функций, компонентов и т.д.-->
<script lang="ts" setup>
import useApi from '../composables/useApi';

const {
    isFinished,
    isFetching,
    statusCode,
    response,
    data,
    isError,
    error,
    execute,
} = useApi('login', {
    email: 'test@test.com',
    password: 'qwertyui',
}, {
    immediate: true,
    onFetchResponse: () => {
        console.log(
            isFinished.value,
            data

        );
    }
})



</script>

<template>
    <q-btn @click="execute()">exec</q-btn>
    <table>
        <tr>
            <td>isFinished:</td>
            <td>{{ isFinished }}</td>
        </tr>
        <tr>
            <td>isFetching:</td>
            <td>{{ isFetching }}</td>
        </tr>
        <tr>
            <td>statusCode:</td>
            <td>{{ statusCode }}</td>
        </tr>
        <tr>
            <td>response:</td>
            <td>{{ JSON.stringify(response) }}</td>
        </tr>
        <tr>
            <td>data:</td>
            <td>{{ JSON.stringify(data) }}</td>
        </tr>
        <tr>
            <td>isError:</td>
            <td>{{ isError }}</td>
        </tr>
        <tr>
            <td>error:</td>
            <td>{{ error }}</td>
        </tr>
    </table>
</template>


<style scoped></style>
