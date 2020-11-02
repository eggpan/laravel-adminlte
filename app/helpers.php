<?php

if(! function_exists('back_with_error')) {
    function back_with_error($message)
    {
        return redirect()->back()->withErrors(['message' => $message]);
    }
}

if(! function_exists('back_with_not_found')) {
    function back_with_not_found($id)
    {
        return back_with_error(__('message.record_not_exist', ['id' => $id]));
    }
}

if(! function_exists('redirect_with_success')) {
    function redirect_with_success($routeName, $message)
    {
        return redirect()
            ->route($routeName)
            ->with(['message.success' => $message]);
    }
}
