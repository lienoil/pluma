@include("Frontier::partials.header")

<v-app id="approot">
    @stack("root")
</v-app>

<script>
    let app = new Vue({
        el: 'v-app',
        data: {
            message: 'Lorem ipsum.'
        }
    });
</script>

@include("Frontier::partials.footer")
