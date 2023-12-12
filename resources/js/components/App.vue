<template>
    <div v-show="this.msg != null" class="alert alert-primary" role="alert">
        Добавлена новая статья {{this.msg}}
    </div>
</template>
<script>
    export default {
        data() { return { msg: null } },
        created() {
            window.Echo.channel('my-channel').listen('CreateArticleEvent', (name) => {
                console.log(name);
                this.msg=name.name;
                // alert('Добавлена новая статья!');
            })
        }
    }
</script>
