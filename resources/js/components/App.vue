<template>
    <div v-if="this.article !== null" class="alert alert-info" role="alert">
        Добавлена новая статья {{this.article.title}}
    </div>
</template>
<script>
    export default {
        data() { return { article: null } },
        created() {
            window.Echo.channel('my-channel').listen('CreateArticleEvent', (data) => {
                console.log(data);
                this.article=data.article;
                // alert('Добавлена новая статья!');
            })
            
        }
    }
</script>
