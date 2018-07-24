export const state = () => ({
  iconmenu: {
    chipColor: 'primary',
    iconColor: 'white--text',
    multiple: false,
    hideDetails: true,
    label: 'Choose Icon',
    model: 'Icon Menu',
    name: 'Categories',
    items: [
      { header: 'Icons' },
      { name: 'Interaction', group: 'Course', icon: 'ondemand_video' },
      { name: 'Video', icon: 'videocam' },
      { name: 'Quiz', icon: 'ballot' },
      { name: 'Dashboard', icon: 'donut_small' },
      { name: 'Widget', icon: 'widgets' },
      { name: 'Pages', icon: 'file_copy' },
      { name: 'Create Page', icon: 'note_add' },
      { name: 'Tag', icon: 'label' },
      { name: 'Announcement', icon: 'announcement' },
      { name: 'Course', icon: 'school' },
      { name: 'Text format', icon: 'text_format' },
      { name: 'Text fields', icon: 'text_fields' },
      { name: 'Wrap text', icon: 'wrap_text' },
      { name: 'Forms', icon: 'list_alt' },
      { name: 'Schedule', icon: 'schedule' },
      { name: 'Submission', icon: 'playlist_add_check' },
      { name: 'Appearance', icon: 'brush' },
      { name: 'User', icon: 'supervisor_account' },
      { name: 'User Role', icon: 'verified_user' },
      { name: 'Settings', icon: 'settings' },
      { name: 'Warning', icon: 'warning' },
      { name: 'Success', icon: 'check' },
      { name: 'Error', icon: 'close' },
      { name: 'Featured Image', icon: 'photo' },
      { name: 'Add Image', icon: 'add_photo_alternate' },
      { name: 'Bookmark', icon: 'bookmark' },
      { name: 'Show Content', icon: 'visibility' },
      { name: 'Hide Content', icon: 'visibility_off' },
      { name: 'Favorite', icon: 'favorite' },
      { name: 'Feedback', icon: 'feedback' },
      { name: 'Starred', icon: 'star' },
      { name: 'Edit', icon: 'edit' },
      { name: 'Delete', icon: 'delete' },
      { name: 'Create', icon: 'add' },
      { name: 'Archive', icon: 'archive' },
      { name: 'Sort', icon: 'sort' },
      { name: 'Filter', icon: 'fa-filter' },
      { name: 'Restore', icon: 'restore' },
      { name: 'Update', icon: 'update' },
      { name: 'Locked', icon: 'lock' },
      { name: 'Unlock', icon: 'lock_open' },
      { name: 'Play', icon: 'play_arrow' },
      { name: 'Shrink', icon: 'fa-compress' },
      { name: 'Expand', icon: 'fa-expand' },
      { name: 'Drag', icon: 'drag_indicator' },
      { name: 'Completed', icon: 'check_circle_outline' }
    ]
  }
})

export const getters = {
  iconmenu: state => state.iconmenu
}

export const mutations = {
  emptyState () {
    this.replaceState({ iconmenu: null })
  }
}

export const iconmenu = {
  namespaced: true,
  state,
  getters,
  mutations
}
