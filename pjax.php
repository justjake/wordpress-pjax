<?php
/**
 * Wordpress Pjax Support
 * @author Jake Teton-Landis <just.1.jake@gmail.com>
 *
 * load pages with history.pushState without re-rendering everything
 * @see https://github.com/defunkt/jquery-pjax
 *
 * use the included pjax_get_header() and pjax_get_footer() functions
 * instead the the built-in Wordpress versions. Doing so will return
 * header-pjax-{header name}.php instead of header-{header name}.php
 * when the X-PJAX HTTP header is set
 *
 * Make sure your header-pjax has a <title> or a `data-title` attribute
 * if you want page titles to work.
 *
 * Copyright ©2012. The Regents of the University of
 * California (Regents). All Rights Reserved. Permission to use, copy, modify,
 * and distribute this software and its documentation for educational, research,
 * and not-for-profit purposes, without fee and without a signed licensing
 * agreement, is hereby granted, provided that the above copyright notice, this
 * paragraph and the following two paragraphs appear in all copies,
 * modifications, and distributions. Contact The Office of Technology Licensing,
 * UC Berkeley, 2150 Shattuck Avenue, Suite 510, Berkeley, CA 94720-1620, (510)
 * 643-7201, for commercial licensing opportunities.
 *
 * Created by Jake Teton-Landis, Residential Computing Marketing Team,
 * Student Affairs Information Technologies
 *
 * IN NO EVENT SHALL REGENTS BE LIABLE TO ANY PARTY FOR DIRECT, INDIRECT,
 * SPECIAL, INCIDENTAL, OR CONSEQUENTIAL DAMAGES, INCLUDING LOST PROFITS, ARISING
 * OUT OF THE USE OF THIS SOFTWARE AND ITS DOCUMENTATION, EVEN IF REGENTS HAS
 * BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * REGENTS SPECIFICALLY DISCLAIMS ANY WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE. THE SOFTWARE AND ACCOMPANYING DOCUMENTATION, IF ANY, PROVIDED
 * HEREUNDER IS PROVIDED "AS IS". REGENTS HAS NO OBLIGATION TO PROVIDE
 * MAINTENANCE, SUPPORT, UPDATES, ENHANCEMENTS, OR MODIFICATIONS.
 *
 *
 * @package WordpressPjax
 */

/**
 * Is this a PJAX (pushState + AJAX) request for a subtle page data change?
 * @return bool
 */
function is_pjax_request() {
    return (isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true');
}

/**
 * Get header $name if this is a normal request. If it's a PJAX request,
 * we don't want these headers!
 * @param null $name
 */
function pjax_get_header($name = null) {
    if (! is_pjax_request())
        get_header($name);
    else {
        if (isset($name))
            get_header('pjax-' . $name);
        else
            get_header('pjax');
    }
}

/**
 * Get footer $name if this is a normal request. If it's a PJAX request,
 * we don't want these footer!
 * @param null $name
 */
function pjax_get_footer($name = null) {
    if (! is_pjax_request())
        get_footer($name);
    else {
        if (isset($name))
            get_footer('pjax-' . $name);
        else
            get_footer('pjax');
    }
}

