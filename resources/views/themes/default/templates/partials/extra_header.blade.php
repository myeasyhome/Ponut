<script type="text/javascript">
	var app_globals = {
		home_url: "{{ url('/') }}",
		api_url: "{{ url('/api') }}",
		notify_url: "{{ route('api.action.notifications.notify') }}",
		running_intervals:{},

		fetch_refresh_token_url: "{{ route('api.action.fetch_refresh_token') }}",
		update_access_token_url: "{{ route('api.action.update_access_token') }}"
	};
</script>
<style type="text/css">

</style>