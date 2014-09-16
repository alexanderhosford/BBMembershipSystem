<?php namespace BB\Html;

use Illuminate\Html\HtmlBuilder as IlluminateHtmlBuilder;

class HtmlBuilder extends IlluminateHtmlBuilder
{

    public function statusLabel($status) {
        if ($status == 'setting-up')
        {
            return '<span class="label label-warning">Setting Up</span>';
        }
        elseif ($status == 'active')
        {
            return '<span class="label label-success">Active</span>';
        }
        elseif ($status == 'payment-warning')
        {
            return '<span class="label label-danger">Payment Warning</span>';
        }
        elseif ($status == 'leaving')
        {
            return '<span class="label label-default">Leaving</span>';
        }
        elseif ($status == 'on-hold')
        {
            return '<span class="label label-default">On Hold</span>';
        }
        elseif ($status == 'left')
        {
            return '<span class="label label-default">Left</span>';
        }
        elseif ($status == 'honorary')
        {
            return '<span class="label label-default">Honorary</span>';
        }
    }

    public function spaceAccessLabel($active) {
        if ($active) {
            return '<label class="label label-success">Access to the space</label>';
        } else {
            return '<label class="label label-danger">No access to he space</label>';
        }
    }

    public function keyHolderLabel($key_holder) {
        if ($key_holder) {
            return '<label class="label label-success">Key Holder</label><br />';
        } else {
            return '<label class="label label-default">Key Holder: not yet</label>';
        }
    }
} 