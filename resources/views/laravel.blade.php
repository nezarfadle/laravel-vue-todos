<script>

window.Laravel = {
	csrfToken: "{{ csrf_token() }}"
}

Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

</script>