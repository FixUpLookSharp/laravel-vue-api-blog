<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <div class="my-4">
                    <layout-menu-settings-component></layout-menu-settings-component>
                    <div>
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="..." class="avatar-img rounded-circle" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">Brown, Asher</h4>
                                        <p class="small mb-3"><span class="badge badge-dark">New York, USA</span></p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-7">
                                        <p class="text-muted">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit nisl ullamcorper, rutrum metus in, congue lectus. In hac habitasse platea dictumst. Cras urna quam, malesuada vitae risus at,
                                            pretium blandit sapien.
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="small mb-0 text-muted">Nec Urna Suscipit Ltd</p>
                                        <p class="small mb-0 text-muted">P.O. Box 464, 5975 Eget Avenue</p>
                                        <p class="small mb-0 text-muted">(537) 315-1481</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">Firstname</label>
                                <input type="text" id="firstname" class="form-control" placeholder="Brown" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Lastname</label>
                                <input type="text" id="lastname" class="form-control" placeholder="Asher" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control"  placeholder="brown@asher.me" />
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control"  placeholder="P.O. Box 464, 5975 Eget Avenue" />
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Company</label>
                                <input type="text" class="form-control" placeholder="Nec Urna Suscipit Ltd" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState5">State</label>
                                <select id="inputState5" class="form-control">
                                    <option selected="">Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Zip</label>
                                <input type="text" class="form-control" placeholder="98232" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LayoutMenuSettingsComponent from "./LayoutMenuSettingsComponent";
    export default {
        components: {LayoutMenuSettingsComponent}
    }
</script>

<style scoped>

</style>
