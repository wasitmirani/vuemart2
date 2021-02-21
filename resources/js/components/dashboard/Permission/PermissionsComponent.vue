<template>
  <div>
    <Breadcrumb
      homeName="Dashboard"
      homeUrl="/"
      activeName="Permissions"
      :breadcrumbbar="true"
    ></Breadcrumb>


    <!--/ Miscellaneous Charts -->

    <!-- Table Hover Animation start -->
    <div class="row" id="table-hover-animation">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" v-can="'PermissionsRead'">Permissions List</h4>
          </div>
          <div class="card-body">
            <div class="card-text row">
              <div class="col-md-10 col-sm-6 col-xs-8">
                <div class="col-md-4">
                  <SearchInput
                    :apiurl="'permission?page=' + this.pageNum"
                    v-on:query="isquery($event)"
                    v-on:isLoading="isLoadingStart($event)"
                    v-on:reload="getpermissions()"
                    v-on:dataList="searchData($event)"
                     v-can="'PermissionsRead'"
                    label="Search permissions"
                  ></SearchInput>
                </div>
              </div>

              <div class="col-md-2 col-sm-6 col-xs-4">
                <button
                  type="button"
                   v-can="'PermissionsCreate'"
                  class=".btn-sm btn-primary form-control"
                  @click="openPopup"
                  style="height: auto"
                >
                  New Permission
                </button>
              </div>
            </div>
          </div>
          <b-overlay :show="isLoading" variants="transparent" rounded="md"  v-can="'PermissionsRead'">
            <PermissionsList
              :permissions="this.permissions"
              :query="query"
               v-can="'PermissionsRead'"
              :getpermissions="getpermissions"
              v-on:editData="editData($event)"
              v-on:deleteData="deleteData($event)"
            ></PermissionsList>
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
            <h4 class="modal-title" v-if="!editMode">Create New Permission</h4>
            <h4 class="modal-title" v-else>Update Permission</h4>
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
            <PermissionForm
              :editMode="editMode"
              :editForm="editCollection"
               v-can="'PermissionsCreate'"
              :roles="this.roles"
              v-on:created="closePopup($event)"
              v-on:updated="closePopup($event)"
            ></PermissionForm>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "../Breadcrumb/BreadcrumbComponent";
import PermissionsList from "./PermissionList";
import SearchInput from "../Search/SearchFilterComponent";
import PermissionForm from "./PermissionForm";
export default {
  components: {
    Breadcrumb,
    PermissionsList,
    SearchInput,
    PermissionForm,
  },
  data() {
    return {
      roles: [],
      users:[],
      permissions:{},

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
        this.getpermissions();
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
      this.permissions = data.permissions;
    },
    getpermissions(page = 1) {
      this.isLoading = true;
      this.page_num = page;
      axios
        .get(
          this.$hostapi_url + "/permission?page=" + page + "&query=" + this.query,
          this.$config
        )
        .then((res) => {
          this.roles = res.data.roles;
        this.permissions = res.data.permissions;

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
            .delete(this.$hostapi_url + "/permission/" + item.id, this.$config)
            .then((res) => {
              this.getpermissions();
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
  },
  mounted() {
    this.getpermissions();
  },
};
</script>

<style>
</style>
