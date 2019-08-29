<template>
    <div class="container-fluid">
        <b-table id="my-table" :busy="load" striped hover :items="items" :fields="fields">
            <template slot="[microtime]" slot-scope="data">
                <i>{{ TimeCounter(data.item.stop_time - data.item.start_time) }}</i>
            </template>
        </b-table>

    </div>
</template>

<script>
    export default {
        name: "Orders",
        data() {
          return {
              load: false,
              items: [],
              fields: [
                  'id','user_id','id','usd','currency','cost',
                  {
                      key: 'start_time',
                      label: 'Start',
                      formatter: (value, key, item) => {
                          return new Date(+(value) * 1000).toLocaleString();
                      }
                  },
                  {
                  key: 'microtime',
                  label: 'Calculated execution time'
              }
              ],
          }
        },
        mounted() {
            this.loadList();
        },
        methods: {
            loadList: function(){
                let t = this;
                t.load = true;

                axios.get('/get_orders')
                    .then(function(response){
                        t.items = response.data.data;
                        t.load = false;
                    })
                    .catch(function(error){
                        console.log(error);
                    })
            },
            timestampToDate: function(ts) {
                var d = new Date();
                d.setTime(ts);
                console.log(d)
                return ts
                return ('0' + d.getDate()).slice(-2) + '.' + ('0' + (d.getMonth() + 1)).slice(-2) + '.' + d.getFullYear();
            },
            TimeCounter: function(val){
                var t = parseInt(val);
                var days = parseInt(t/86400);
                t = t-(days*86400);
                var hours = parseInt(t/3600);
                t = t-(hours*3600);
                var minutes = parseInt(t/60);
                t = t-(minutes*60);
                var content = "";
                if(days)content+=days+" д";
                if(hours||days){ if(content)content+=", "; content+=hours+" ч"; }
                if(content)content+=", "; content+=minutes+" м "+t+" с.";
                return content;
            }
        }
    }
</script>

