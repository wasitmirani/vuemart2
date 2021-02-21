<template>
  <div class="form-group">
    <input
      type="search"
      class="form-control"
      id="basicInput"
       v-model="query" aria-label="Search" v-on:keyup="searchQuery"
      :placeholder="label"
    />
  </div>
</template>

<script>
export default {
  props: ["apiurl", "label"],
  data() {
    return {
      query: "",
    };
  },
  methods: {
    //asyncdata
    searchQuery: _.debounce(
      function () {
        this.$emit("isLoading", true);
        this.search();
      },
      500 // 500 milliseconds
    ),

    search() {
      if (this.query.length > 1) {
    
        axios
          .get(
            this.$hostapi_url + "/" + this.apiurl + "&query=" + this.query,
            this.$config
          )
          .then((response) => {
            this.$emit("isLoading", false);

            this.$emit("dataList", response.data);

            this.$emit("query", this.query);
          });
      } else {
        this.query = "";
        this.$emit("query", this.query);
        this.$emit("reload");
      }
    },
  },
  watch: {
    query() {
      if (this.query == "") {
        this.query = "";
        this.$emit("query", this.query);
        this.$emit("reload");
      }
    },
  },
};
</script>

<style>
</style>
