<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="Slider "
      :breadcrumbbar="true"
    ></Breadcrumb>


    <!--/ Miscellaneous Charts -->

    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation" >
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"  v-can="'AppSliderRead'">Slider List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'slider?page=' + this.pageNum"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getSlider()"
                    v-on:dataList="searchData($event)"
                    label="Search Heading"
                    v-can="'AppSliderRead'"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4">
                <button
                  type="button"
                 v-can="'AppSliderCreate'"
                  class=".btn-sm btn-primary form-control"
                  @click="openPopup"
                  style="height: auto"
                >
                  New Slider
                </button>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md" v-can="'AppSliderRead'">
            <SliderList
              :sliders="this.sliders"
              :query="query"
              v-can="'AppSliderRead'"
              :getSlider="getSlider"
              v-on:editData="editData($event)"
              v-on:deleteData="deleteData($event)"
            ></SliderList>
          </b-overlay>

          <!-- Table -->
        </div>
      </div>
    </div>
    <!-- Table head options end -->
    <!-- Modal -->
    <div
      class="modal fade text-left"
      id="modal_id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel17"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-if="!editMode">Create New Slider</h4>
            <h4 class="modal-title" v-else>Update Slider</h4>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <SliderForm
              :editMode="editMode"
              v-can="'AppSliderCreate'"
              :editForm="editCollection"
              v-on:created="closePopup($event)"
              v-on:updated="closePopup($event)"
            ></SliderForm>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";
import SliderList from "./SliderList";
import SearchInput from "../Search/SearchFilterComponent";
import SliderForm from "./SliderForm";
export default {
  components: {
    Breadcrumb,
    SliderList,
    SearchInput,
    SliderForm,
  },
  data() {
    return {
      sliders: {},

      isLoading: false,
      pageNum: 1,
      query: "",
      editMode: false,
      editCollection: {},
    };
  },
  methods: {
    isLoadingStart(value) {
      this.isLoading = value;
    },
    openPopup() {
      this.editMode = false;
      this.editCollection = null;
      $("#modal_id").modal("show");
    },
    closePopup(item) {
      if (item) {
        this.getSlider();
        $("#modal_id").modal("hide");
      }
    },
    isquery(query) {
      return (this.query = query);
    },
    editData(item) {
      this.editMode = true;
      this.editCollection = item;
      $("#modal_id").modal("show");
    },
    searchData(data) {
      this.sliders = data;
    },
    getSlider(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url + "/slider?page=" + page + "&query=" + this.query,
          this.$config
        )
        .then((res) => {
          this.sliders = res.data;

          this.isLoading = false;
        })
        .catch((er) => {
          //   console.log(er.response.data.errors);
        });
    },

    deleteData(item) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(this.$hostapi_url + "/slider/" + item.id, this.$config)
            .then((res) => {
              this.getSlider();
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
  },
  mounted() {
    this.getSlider();
  },
};
</script>

<style>
</style>
