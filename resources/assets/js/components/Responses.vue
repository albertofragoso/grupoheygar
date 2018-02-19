<template>
  <div id="new-updates" class="card updates recent-updated">
    <div id="updates-header" class="card-header d-flex justify-content-between align-items-center" v-on:click="load">
      <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box" class="">Comentarios</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box" class=""><i class="fa fa-angle-down"></i></a>
    </div>
    <div id="updates-box" role="tabpanel" class="collapse show" style="" v-for="response in responses">
      <ul class="news list-unstyled">
        <li class="d-flex justify-content-between">
          <div class="left-col d-flex">
            <div class="icon"><i class="icon-rss-feed"></i></div>
            <div class="title"><strong>{{ response.message }}</strong>
              <p>{{ response.user.name }}</p>
            </div>
          </div>
          <div class="right-col text-right">
            <div class="update-date">{{ response.created_at }}<span class="month">Jan</span></div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['product'],
    data() {
      return {
        responses: []
      }
    },
    methods: {
      load() {
        axios.get('/api/products/'+ this.product +'/responses')
          .then(res => {
            this.responses = res.data;
          });
      }
    }
  }
</script>
