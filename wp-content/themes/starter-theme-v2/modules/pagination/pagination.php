{% if pagination.pages is not empty %}
  <nav class="pagination">

    <ul class="pagination__pages">

      {% if pagination.prev %}
        <li class="pagination__page">
          <a href="{{pagination.prev.link}}" class="pagination__link pagination__link--prev {{pagination.prev.link|length ? '' : 'hidden-text'}}">Prev</a>
        </li>
      {% endif %}

      {% for page in pagination.pages %}
        <li class="pagination__page">
          {% if page.link %}
            <a href="{{page.link}}" class="pagination__link {{page.class}}">{{page.title}}</a>
          {% else %}
            <span class="{{page.class}}">{{page.title}}</span>
          {% endif %}
        </li>
      {% endfor %}

      {% if pagination.next %}
        <li class="pagination__page">
          <a href="{{pagination.next.link}}" class="pagination__link pagination__link--next {{pagination.next.link|length ? '' : 'hidden-text'}}">Next</a>
        </li>
    {% endif %}
    </ul>
  </nav>
{% endif %}
