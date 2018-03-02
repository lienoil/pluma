<template>
  <div class="contextual-alert-icon-container" :class="{
    'contextual-alert-icon-small': small === true,
    'contextual-alert-icon-large': large === true
  }">
    <div v-if="mode === 'error'" class="contextual-alert-icon alert-icon-error animate">
      <span class="alert-icon-x-mark">
        <span class="alert-icon-line alert-icon-left animateXLeft"></span>
        <span class="alert-icon-line alert-icon-right animateXRight"></span>
      </span>
      <div class="alert-icon-placeholder"></div>
      <div class="alert-icon-fix"></div>
    </div>

    <div v-else-if="mode === 'warning'" class="contextual-alert-icon alert-icon-warning scaleWarning">
      <span class="alert-icon-body pulseWarningIns"></span>
      <span class="alert-icon-dot pulseWarningIns"></span>
    </div>

    <div v-else-if="mode === 'success'" class="contextual-alert-icon alert-icon-success animate">
      <span class="alert-icon-line alert-icon-tip animateSuccessTip"></span>
      <span class="alert-icon-line alert-icon-long animateSuccessLong"></span>
      <div class="alert-icon-placeholder"></div>
      <div class="alert-icon-fix"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AlertIcon',
  props: {
    small: { type: Boolean, default: false },
    large: { type: Boolean, default: false },
    mode: { default: 'success' }
  },
  data () {
    return []
  },
  mounted () {
    // alert(this.large)
  }
}
</script>

<style scoped>
.contextual-alert-icon-container {
  position: relative;
  background: inherit;
  padding: 1rem;
}
.contextual-alert-icon-small .contextual-alert-icon {
  zoom: 0.5;
}
.contextual-alert-icon-large .contextual-alert-icon {
  zoom: 1.5;
}
.contextual-alert-icon {
  background: inherit;
  border-radius: 50%;
  border: 4px solid rgba(0,0,0,0.2);
  -webkit-box-sizing: content-box;
          box-sizing: content-box;
  height: 80px;
  margin: 20px auto;
  padding: 0;
  position: relative;
  width: 80px;
  zoom: 0.8;
}
.contextual-alert-icon.alert-icon-success, .contextual-alert-icon.alert-icon-error {
  border-color: #A5DC86;
}
.contextual-alert-icon.alert-icon-success:after, .contextual-alert-icon.alert-icon-success:before, .contextual-alert-icon.alert-icon-error:after, .contextual-alert-icon.alert-icon-error:before {
  background: inherit;
  content: '';
  height: 120px;
  position: absolute;
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
  width: 60px;
}
.contextual-alert-icon.alert-icon-success:before, .contextual-alert-icon.alert-icon-error:before {
  border-radius: 120px 0 0 120px;
  left: -33px;
  top: -7px;
  -webkit-transform-origin: 60px 60px;
          transform-origin: 60px 60px;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
}
.contextual-alert-icon.alert-icon-success:after, .contextual-alert-icon.alert-icon-error:after {
  border-radius: 0 120px 120px 0;
  left: 30px;
  top: -11px;
  -webkit-transform-origin: 0 60px;
          transform-origin: 0 60px;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
}
.contextual-alert-icon.alert-icon-success .alert-icon-placeholder, .contextual-alert-icon.alert-icon-error .alert-icon-placeholder {
  border-radius: 50%;
  border: 4px solid rgba(165, 220, 134, 0.2);
  -webkit-box-sizing: content-box;
          box-sizing: content-box;
  height: 80px;
  left: -4px;
  position: absolute;
  top: -4px;
  width: 80px;
  z-index: 2;
}
.contextual-alert-icon.alert-icon-success .alert-icon-fix, .contextual-alert-icon.alert-icon-error .alert-icon-fix {
  background-color: inherit;
  height: 90px;
  left: 28px;
  position: absolute;
  top: 8px;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
  width: 5px;
  z-index: 1;
}
.contextual-alert-icon.alert-icon-success .alert-icon-line, .contextual-alert-icon.alert-icon-error .alert-icon-line {
  background-color: #A5DC86;
  border-radius: 2px;
  display: block;
  height: 5px;
  position: absolute;
  z-index: 2;
}
.contextual-alert-icon.alert-icon-success .alert-icon-line.alert-icon-tip, .contextual-alert-icon.alert-icon-error .alert-icon-line.alert-icon-tip {
  left: 14px;
  top: 46px;
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
  width: 25px;
}
.contextual-alert-icon.alert-icon-success .alert-icon-line.alert-icon-long, .contextual-alert-icon.alert-icon-error .alert-icon-line.alert-icon-long {
  right: 8px;
  top: 38px;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
  width: 47px;
}
.contextual-alert-icon.alert-icon-error {
  border-color: #F27474;
}
.contextual-alert-icon.alert-icon-error .alert-icon-x-mark {
  display: block;
  position: relative;
  z-index: 2;
}
.contextual-alert-icon.alert-icon-error .alert-icon-placeholder {
  border: 4px solid rgba(200, 0, 0, 0.2);
}
.contextual-alert-icon.alert-icon-error .alert-icon-line {
  background-color: #F27474;
  top: 37px;
  width: 47px;
}
.contextual-alert-icon.alert-icon-error .alert-icon-line.alert-icon-left {
  left: 17px;
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
}
.contextual-alert-icon.alert-icon-error .alert-icon-line.alert-icon-right {
  right: 16px;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
}
.contextual-alert-icon.alert-icon-warning {
  border-color: #F8BB86;
}
.contextual-alert-icon.alert-icon-warning:before {
  -webkit-animation: pulseWarning 2s linear infinite;
          animation: pulseWarning 2s linear infinite;
  background-color: inherit;
  border-radius: 50%;
  content: "";
  display: inline-block;
  height: 100%;
  opacity: 0;
  position: absolute;
  width: 100%;
}
.contextual-alert-icon.alert-icon-warning:after {
  background-color: inherit;
  border-radius: 50%;
  content: '';
  display: block;
  height: 100%;
  position: absolute;
  width: 100%;
  z-index: 1;
}
.contextual-alert-icon.alert-icon-warning .alert-icon-body {
  background-color: #F8BB86;
  border-radius: 2px;
  height: 47px;
  left: 50%;
  margin-left: -2px;
  position: absolute;
  top: 10px;
  width: 5px;
  z-index: 2;
}
.contextual-alert-icon.alert-icon-warning .alert-icon-dot {
  background-color: #F8BB86;
  border-radius: 50%;
  bottom: 10px;
  height: 7px;
  left: 50%;
  margin-left: -3px;
  position: absolute;
  width: 7px;
  z-index: 2;
}
.contextual-alert-icon + .contextual-alert-icon {
  margin-top: 50px;
}

.animateSuccessTip {
  -webkit-animation: animateSuccessTip .75s;
          animation: animateSuccessTip .75s;
}

.animateSuccessLong {
  -webkit-animation: animateSuccessLong .75s;
          animation: animateSuccessLong .75s;
}

.contextual-alert-icon.alert-icon-success.animate:after {
  -webkit-animation: rotatePlaceholder 4.25s ease-in;
          animation: rotatePlaceholder 4.25s ease-in;
}

.contextual-alert-icon.alert-icon-error.animate:after {
  -webkit-animation: rotatePlaceholder 4.25s ease-in;
          animation: rotatePlaceholder 4.25s ease-in;
}

.animateErrorIcon {
  -webkit-animation: animateErrorIcon .5s;
          animation: animateErrorIcon .5s;
}

.animateXLeft {
  -webkit-animation: animateXLeft .75s;
          animation: animateXLeft .75s;
}

.animateXRight {
  -webkit-animation: animateXRight .75s;
          animation: animateXRight .75s;
}

.scaleWarning {
  -webkit-animation: scaleWarning 0.75s infinite alternate;
          animation: scaleWarning 0.75s infinite alternate;
}

.pulseWarningIns {
  -webkit-animation: pulseWarningIns 0.75s infinite alternate;
          animation: pulseWarningIns 0.75s infinite alternate;
}

@-webkit-keyframes animateSuccessTip {
  0%,54% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  70% {
    width: 50px;
    left: -8px;
    top: 37px;
  }
  84% {
    width: 17px;
    left: 21px;
    top: 48px;
  }
  100% {
    width: 25px;
    left: 14px;
    top: 45px;
  }
}

@keyframes animateSuccessTip {
  0%,54% {
    width: 0;
    left: 1px;
    top: 19px;
  }
  70% {
    width: 50px;
    left: -8px;
    top: 37px;
  }
  84% {
    width: 17px;
    left: 21px;
    top: 48px;
  }
  100% {
    width: 25px;
    left: 14px;
    top: 45px;
  }
}
@-webkit-keyframes animateSuccessLong {
  0%,65% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  84% {
    width: 55px;
    right: 0;
    top: 35px;
  }
  100% {
    width: 47px;
    right: 8px;
    top: 38px;
  }
}
@keyframes animateSuccessLong {
  0%,65% {
    width: 0;
    right: 46px;
    top: 54px;
  }
  84% {
    width: 55px;
    right: 0;
    top: 35px;
  }
  100% {
    width: 47px;
    right: 8px;
    top: 38px;
  }
}
@-webkit-keyframes rotatePlaceholder {
  0%,5% {
    -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
  }
  100%,12% {
    -webkit-transform: rotate(-405deg);
            transform: rotate(-405deg);
  }
}
@keyframes rotatePlaceholder {
  0%,5% {
    -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
  }
  100%,12% {
    -webkit-transform: rotate(-405deg);
            transform: rotate(-405deg);
  }
}
@-webkit-keyframes animateErrorIcon {
  0% {
    -webkit-transform: rotateX(100deg);
            transform: rotateX(100deg);
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
    opacity: 1;
  }
}
@keyframes animateErrorIcon {
  0% {
    -webkit-transform: rotateX(100deg);
            transform: rotateX(100deg);
    opacity: 0;
  }
  100% {
    -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
    opacity: 1;
  }
}
@-webkit-keyframes animateXLeft {
  0%,
  65% {
    left: 82px;
    top: 95px;
    width: 0;
  }
  84% {
    left: 14px;
    top: 33px;
    width: 47px;
  }
  100% {
    left: 17px;
    top: 37px;
    width: 47px;
  }
}
@keyframes animateXLeft {
  0%,
  65% {
    left: 82px;
    top: 95px;
    width: 0;
  }
  84% {
    left: 14px;
    top: 33px;
    width: 47px;
  }
  100% {
    left: 17px;
    top: 37px;
    width: 47px;
  }
}
@-webkit-keyframes animateXRight {
  0%,
  65% {
    right: 82px;
    top: 95px;
    width: 0;
  }
  84% {
    right: 14px;
    top: 33px;
    width: 47px;
  }
  100% {
    right: 16px;
    top: 37px;
    width: 47px;
  }
}
@keyframes animateXRight {
  0%,
  65% {
    right: 82px;
    top: 95px;
    width: 0;
  }
  84% {
    right: 14px;
    top: 33px;
    width: 47px;
  }
  100% {
    right: 16px;
    top: 37px;
    width: 47px;
  }
}
@-webkit-keyframes scaleWarning {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  30% {
    -webkit-transform: scale(1.02);
            transform: scale(1.02);
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
@keyframes scaleWarning {
  0% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
  30% {
    -webkit-transform: scale(1.02);
            transform: scale(1.02);
  }
  100% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
@-webkit-keyframes pulseWarning {
  0% {
    background-color: inherit;
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 0.5;
  }
  30% {
    background-color: inherit;
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 0.5;
  }
  100% {
    background-color: #F8BB86;
    -webkit-transform: scale(2);
            transform: scale(2);
    opacity: 0;
  }
}
@keyframes pulseWarning {
  0% {
    background-color: inherit;
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 0.5;
  }
  30% {
    background-color: inherit;
    -webkit-transform: scale(1);
            transform: scale(1);
    opacity: 0.5;
  }
  100% {
    background-color: #F8BB86;
    -webkit-transform: scale(2);
            transform: scale(2);
    opacity: 0;
  }
}
@-webkit-keyframes pulseWarningIns {
  0% {
    background-color: #F8D486;
  }
  100% {
    background-color: #F8BB86;
  }
}
@keyframes pulseWarningIns {
  0% {
    background-color: #F8D486;
  }
  100% {
    background-color: #F8BB86;
  }
}
</style>
