{% if (socials) %}
  <nav class="social-list" itemscope itemtype="http://schema.org/Organization">
    <link itemprop="url" href="{{site.url}}">

    <ul class="social-list__items">
      {% for social in socials %}
        <li class="social-list__item">
          <a itemprop="sameAs" class="social-list__link" href="{{social.url}}" target="_blank">
            {{social.type|svg}}

            <span class="hidden-text">
              {{social.label}}
            </span>
          </a>
        </li>
      {% endfor %}
    </ul>
  </nav>
{% endif %}
