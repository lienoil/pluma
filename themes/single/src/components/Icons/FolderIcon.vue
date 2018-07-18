<template>
  <svg
    :height="height"
    :width="width"
    id="Capa_1"
    version="1.1"
    viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;"
    xml:space="preserve"
    x="0px" y="0px"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    xmlns="http://www.w3.org/2000/svg"
    >
    <path opacity="0.6" :fill="iconColor" d="M46.324,52.5H1.565c-1.03,0-1.779-0.978-1.51-1.973l10.166-27.871
      c0.184-0.682,0.803-1.156,1.51-1.156H56.49c1.03,0,1.51,0.984,1.51,1.973L47.834,51.344C47.65,52.026,47.031,52.5,46.324,52.5z"/>
    <path opacity="0.2" :fill="iconColor" d="M10.221,22.656c0.184-0.683,0.803-1.156,1.51-1.156H53v-7H9l-6,6v21.953L10.221,22.656z"/>
    <path opacity="0.8" :fill="iconColor" d="M23.571,10.5L20,5.5H1.732C0.776,5.5,0,6.275,0,7.232V49.96c0.069,0.002,0.138,0.006,0.205,0.01
      L3,42.349V20.5l2-2v-8H23.571z"/>
    <polygon fill="#F4F4F4" points="5,10.5 5,18.5 9,14.5 51,14.5 51,10.5 "/>
    <rect x="28" y="19.5" opacity="0.1" :fill="iconColor" width="2" height="2"/>
    <rect x="35" y="19.5" opacity="0.1" :fill="iconColor" width="2" height="2"/>
    <rect x="42" y="19.5" opacity="0.1" :fill="iconColor" width="2" height="2"/>
    <rect x="14" y="19.5" opacity="0.1" :fill="iconColor" width="2" height="2"/>
    <rect x="21" y="19.5" opacity="0.1" :fill="iconColor" width="2" height="2"/>
    <polygon opacity="0.6" :fill="iconColor" points="9,20.5 9,14.5 3,20.5 "/>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
    <g>
    </g>
  </svg>
</template>

<script>
export default {
  props: {
    width: {
      type: [Number, String],
      default: 18
    },
    height: {
      type: [Number, String],
      default: 18
    },
    iconColor: {
      type: String,
      default: 'currentColor'
    }
  }
}
</script>
