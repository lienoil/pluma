let VueDateRange = {
  init(data) {
    this.initVueDateRange = Object.assign({
      lang: 'en',
      range: { startDate: moment(), endDate: moment() },
      format: 'YYYY/MM/DD',
    }, data);

    return this.get();
  },

  get () {
    let self = this;

    return {
      components: {
        'daterange': daterange.DateRange,
      },
      data () {
        return {
          vueDateRange: self.initVueDateRange,
        }
      },
      methods: {
        remove (from, i) {
          from.splice(i, 1);
        },
        onVueDateRangeChange (range) {
          this.vueDateRange.range = range;
          this.vueDateRange.dates = this.setDates(range);
        },
        setDates (range) {
          let dates = [];
          let sd = moment(range.startDate);
          let ed = moment(range.endDate);
          while (sd <= ed) {
            dates.push({moment: moment(sd), value: moment(sd).format(this.vueDateRange.format)});
            sd = moment(sd).add(1, 'days');
          }

          return dates;
        },
        setRange (p) {
          if (typeof p === 'number') {
            this.vueDateRange.range = {
              startDate: moment().add(p, 'days').format(this.vueDateRange.range),
              endDate: moment().format(this.vueDateRange.range),
            }
            this.vueDateRange.dates = this.setDates(this.vueDateRange.range);
          }
        },
        removeSundays (dates) {
          let d = dates.filter(date => {
            // 0 = Sunday
            return (date.moment.format('d') != 0);
          });

          return d;
        }
      },
      mounted () {
        this.vueDateRange.dates = this.setDates(this.vueDateRange.range);
      }
    }
  }
}
