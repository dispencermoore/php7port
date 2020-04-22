<div class="modal fade" id="search-tip-modal" tabindex="-1" role="dialog" aria-labelledby="search-tip-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Advanced Search Tips</h4>
      </div>
      <div class="modal-body">
        <p><a href="https://dev.mysql.com/doc/refman/5.5/en/fulltext-boolean.html" target="blank">Mysql's full set of boolean search operators</a> are available in our search. Below you'll find some helpful examples.
        </p>
          <ul class="itemizedlist" style="list-style-type: disc; "><li class="listitem"><p>
            <code class="literal">'apple banana'</code>
          </p><p>
            Find rows that contain at least one of the two words.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple +juice'</code>
          </p><p>
            Find rows that contain both words.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple macintosh'</code>
          </p><p>
            Find rows that contain the word <span class="quote">"<span class="quote">apple</span>"</span>, but
            rank rows higher if they also contain
            <span class="quote">"<span class="quote">macintosh</span>"</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple -macintosh'</code>
          </p><p>
            Find rows that contain the word <span class="quote">"<span class="quote">apple</span>"</span> but not
            <span class="quote">"<span class="quote">macintosh</span>"</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'apple*'</code>
          </p><p>
            Find rows that contain words such as <span class="quote">"<span class="quote">apple</span>"</span>,
            <span class="quote">"<span class="quote">apples</span>"</span>, <span class="quote">"<span class="quote">applesauce</span>"</span>, or
            <span class="quote">"<span class="quote">applet</span>"</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'"some words"'</code>
          </p><p>
            Find rows that contain the exact phrase <span class="quote">"<span class="quote">some
            words</span>"</span> (for example, rows that contain <span class="quote">"<span class="quote">some
            words of wisdom</span>"</span> but not <span class="quote">"<span class="quote">some noise
            words</span>"</span>). Note that the
            <span class="quote">"<span class="quote"><code class="literal">"</code></span>"</span> characters that enclose
            the phrase are operator characters that delimit the phrase.
            They are not the quotation marks that enclose the search
            string itself.
          </p></li></ul>
      </div>
<!--
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
-->
    </div>
  </div>
</div>