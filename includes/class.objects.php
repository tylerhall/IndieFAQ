<?PHP
    // Stick your DBOjbect subclasses in here (to help keep things tidy).

    class User extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('users', array('nid', 'username', 'password', 'level'), $id);
        }
    }

    class KBArticle extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('kb_articles', array('title', 'slug', 'body', 'section_id', 'keywords', 'published', 'dt_created', 'dt_modified', 'pinned', 'views'), $id);
        }

		public function url()
		{
			return $this->id . '/' . $this->slug . '/';
		}
	}

    class KBSection extends DBObject
    {
        public function __construct($id = null)
        {
            parent::__construct('kb_sections', array('title'), $id);
        }

		public function articles()
		{
			$articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles WHERE section_id = '{$this->id}' ORDER BY views DESC, dt_modified DESC");
			return $articles;			
		}
	}
