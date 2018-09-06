<template v-if="snackbar">
    <v-snackbar
        :bottom="snackbar.y === 'bottom'"
        :error="snackbar.context === 'error'"
        :info="snackbar.context === 'info'"
        :left="snackbar.x === 'left'"
        :multi-line="snackbar.mode === 'multi-line'"
        :primary="snackbar.context === 'primary'"
        :right="snackbar.x === 'right'"
        :secondary="snackbar.context === 'secondary'"
        :success="snackbar.context === 'success'"
        :timeout="snackbar.timeout"
        :top="snackbar.y === 'top'"
        :vertical="snackbar.mode === 'vertical'"
        :warning="snackbar.context === 'warning'"
        v-model="snackbar.model"
    >
        @{{ snackbar.text }}
        <v-btn dark flat @click.native="snackbar.model = false">Close</v-btn>
    </v-snackbar>
</template>
