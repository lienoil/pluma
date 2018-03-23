let FeaturedImage = {
    init ({categories, old}) {
        this.categories = categories;
        this.old = old;

        return this.get();
    },

    get () {
        let self = this;
        return {
            data () {
                return {
                    featuredImage: {
                        old: [],
                        current: null,
                        new: null,
                        categories: [],
                        category: {
                            current: {},
                        },
                        model: false,
                    }
                }
            },

            mounted () {
                this.featuredImage.categories = self.categories;
                this.featuredImage.old = self.old;
            },
        }
    }
};
