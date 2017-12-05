<template>
  <div class="calendar-container">
    <flat-pickr
      :name="name"
      v-model="dDates"
      :config.sync="dConfig"
    ></flat-pickr>
  </div>
</template>

<script>
  import flatPickr from 'vue-flatpickr-component';

  export default {
    name: 'multi-purpose-calendar',
    components: {
      'flat-pickr': flatPickr,
    },
    model: {
      prop: 'dates',
    },
    props: {
      dates: {
        type: [String, Array],
        default: '',
      },
      config: {
        type: Object,
        default: () => {
          return { mode: 'multiple' };
        }
      },
      name: {
        type: String,
        default: 'date'
      },
      color: {
        type: String,
        default: 'primary white--text',
      }
    },
    data() {
      return {
        dDates: '',
        dConfig: {
          mode: "multiple",
          inline: true,
          altInputClass: 'primary',
          onDayCreate: this.calendarOnDayCreate,
          onChange: this.calendarOnChange,
        }
      };
    },

    methods: {
      calendarOnDayCreate (dObj, dStr, fp, dayElem) {
        if (dayElem.classList.contains('selected')) {
          this.color.split(' ').forEach(c => {
            dayElem.classList.add(c.trim());
          })
        }
        dayElem.innerHTML += '<span class="indicator"></span>';

        this.$emit('day-change', dObj, dStr, fp, dayElem);
      },

      calendarOnChange (selectedDates, dateStr, instance) {
        this.$emit('change', selectedDates, dateStr, instance);
      }
    },
    mounted () {
      this.dDates = this.dates;
      this.dConfig = Object.assign(this.dConfig, this.config);
    },
    watch: {
      'dates': function (val) {
        this.dDates = val;
      },
      'dDates': function (val) {

        this.$emit('input', val);
      },
      'config': function (val) {
        // alert('asd');
        this.dConfig = Object.assign(this.dConfig, val);
      }
    }
  };
</script>

<style lang="scss">
  @import '~flatpickr/dist/flatpickr.css';
  .calendar-container {
    overflow: hidden;
    display: inline-block;
  }
  .flatpickr-day.selected:not(.today) {
    border-radius: 0;
  }
  input[data-input].flatpickr-input {
    display: none;
  }
  .flatpickr-calendar.arrowTop::before,
  .flatpickr-calendar.arrowTop::after {
    content: '';
    display: none;
  }
  .flatpickr-calendar.inline {
    padding: 15px;
    width: 337px;
    /*border: 1px solid red; */
    border: none;
    // border-radius: 0;
    box-shadow: none;
    background: transparent;
  }
  .flatpickr-days {
    .flatpickr-day {
      padding: 5px;
      margin: 2px 0;
      line-height: normal;
      height: auto;
      transition: 0.5s;
    }
  }
  .flatpickr-weekdays {
    padding-top: 5px;
    padding-bottom: 5px;
  }
  .flatpickr-month {
    width: 100%;
    height: 40px;
    // padding: 15px 0;
    position: relative;
    align-content: center;
    display: table;
    .flatpickr-current-month,
    .flatpickr-prev-month,
    .flatpickr-next-month {
      height: auto;
      text-align: center;
      vertical-align: middle;
      float: left;
      display: table-cell !important;
    }
    .flatpickr-current-month {
      padding-top: 0;
    }
  }
  .flatpickr-current-month {
    span.cur-month, .numInputWrapper {
      padding: 8px;
      margin: 0;
    }
  }
</style>
